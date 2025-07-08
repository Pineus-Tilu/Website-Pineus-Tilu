<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use App\Models\AreaUnit;
use App\Models\Area;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    public function showReservasi()
    {
        $areas = Area::all();
        $areaUnits = AreaUnit::with('area')->get()->groupBy(function ($unit) {
            return $unit->area->name;
        });

        $prices = [];
        $bookedDates = [];
        $now = Carbon::now('Asia/Jakarta');

        foreach ($areaUnits as $areaName => $units) {
            foreach ($units as $unit) {
                // Handle prices
                $price = Price::where('unit_id', $unit->id)->first();
                $area = Area::find($unit->area_id);
                if ($price && $area) {
                    $prices[$areaName][$unit->unit_name] = [
                        'weekday' => (float) $price->weekday,
                        'weekend' => (float) $price->weekend,
                        'highseason' => (float) $price->highseason,
                        'default_people' => (int) $unit->default_people,
                        'extra_charge' => (float) $area->extra_charge,
                        'max_people' => (int) $unit->max_people,
                    ];
                }
                
                // Gunakan key unik (area + deck)
                $uniqueKey = $areaName . " - " . $unit->unit_name;
                
                $bookings = Booking::where('unit_id', $unit->id)
                    ->whereIn('status_id', [1, 2])
                    ->where('booking_for_date', '>=', $now->format('Y-m-d'))
                    ->get();
                
                $disabledDates = $bookings->pluck('booking_for_date')
                    ->map(function($date) {
                        return Carbon::parse($date)->format('Y-m-d');
                    })
                    ->unique()
                    ->values()
                    ->toArray();
                
                // Tambahkan hari ini jika sudah lewat jam 12:00
                if ($now->hour >= 12) {
                    $today = $now->format('Y-m-d');
                    if (!in_array($today, $disabledDates)) {
                        $disabledDates[] = $today;
                    }
                }
                
                sort($disabledDates);
                $bookedDates[$uniqueKey] = array_values($disabledDates);
            }
        }

        return view('reservasi', [
            'prices' => $prices,
            'areaUnits' => $areaUnits,
            'areas' => $areas,
            'bookedDates' => $bookedDates,
            'currentTime' => $now->format('H:i'),
            'isAfterCutoff' => $now->hour >= 12,
        ]);
    }

    public function storeReservasi(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_kunjungan' => ['required', 'date', 'after_or_equal:today'],
            'fasilitas' => 'required',
            'deck' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'jumlah_orang' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        $errors = [];
        
        // Validasi waktu pemesanan untuk hari ini
        $now = Carbon::now('Asia/Jakarta');
        $bookingDate = Carbon::parse($request->tanggal_kunjungan);
        
        if ($bookingDate->isToday() && $now->hour >= 12) {
            $errors['tanggal_kunjungan'] = 'Pemesanan untuk hari ini sudah ditutup. Check-in dimulai pukul 14:00, pemesanan harus dilakukan sebelum pukul 12:00.';
        }

        // Cari unit_id berdasarkan area (fasilitas) dan deck
        $unit = AreaUnit::whereHas('area', function ($q) use ($request) {
            $q->where('name', $request->fasilitas);
        })->where('unit_name', $request->deck)->first();

        if (!$unit) {
            $errors['deck'] = 'Deck tidak ditemukan.';
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        return $this->processBooking($request, $unit);
    }

    private function processBooking(Request $request, $unit)
    {
        // Validasi duplikasi yang lebih ketat dengan database lock
        DB::beginTransaction();
        
        try {
            // Lock dan cek lagi untuk mencegah race condition
            $existingBooking = Booking::where('unit_id', $unit->id)
                ->where('booking_for_date', $request->tanggal_kunjungan)
                ->whereIn('status_id', [1, 2]) // pending atau success
                ->lockForUpdate() // Database lock
                ->first();

            if ($existingBooking) {
                DB::rollBack();
                return back()->withErrors(['tanggal_kunjungan' => 'Tanggal ini sudah dipesan untuk deck tersebut. Silakan pilih tanggal lain.'])->withInput();
            }

            // Ambil harga dan data terkait
            $price = Price::where('unit_id', $unit->id)->first();
            $area = Area::find($unit->area_id);

            // Hitung harga sesuai season
            $tanggal = $request->tanggal_kunjungan;
            $checkout = date('Y-m-d', strtotime($tanggal . ' +1 day'));
            $jumlah = (int) $request->jumlah_orang;
            $defaultPeople = (int) $unit->default_people;
            $extraCharge = (float) $area->extra_charge;

            // Tentukan season
            $season = $this->getSeason($tanggal);
            $hargaDasar = $price ? (float) $price->$season : 0;

            // Hitung total
            $extra = 0;
            if ($jumlah > $defaultPeople) {
                $extra = ($jumlah - $defaultPeople) * $extraCharge;
            }
            $total = $hargaDasar + $extra;

            // Gunakan total dari frontend jika ada
            $totalFromRequest = (float) $request->total_harga;
            if ($totalFromRequest > 0) {
                $total = $totalFromRequest;
            }

            // Simpan ke tabel bookings dengan status pending (default)
            $booking = Booking::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'unit_id' => $unit->id,
                'booking_for_date' => $tanggal,
                'status_id' => 1, // 1 = pending (default)
                'total_amount' => $total,
            ]);

            // Simpan ke tabel booking_details
            BookingDetail::create([
                'booking_id' => $booking->id,
                'number_of_people' => $jumlah,
                'extra_charge' => $extra,
                'notes' => null,
                'total_price' => $total,
                'check_in' => $tanggal,
                'check_out' => $checkout,
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'email' => $request->email,
            ]);

            DB::commit();

            // Redirect ke halaman pembayaran dengan parameter GET
            return redirect()->route('pembayaran', [
                'booking_id' => $booking->id,
                'tanggal_kunjungan' => $tanggal,
                'fasilitas' => $request->fasilitas,
                'deck' => $request->deck,
                'jumlah_orang' => $jumlah,
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'subtotal' => $total,
                'status' => 'pending'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Booking creation failed: " . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // Fungsi bantu season
    private function getSeason($date)
    {
        $d = date_create($date);
        $dayOfWeek = (int) date_format($d, 'w'); // 0=minggu, 1=senin, ..., 6=sabtu
        $year = (int) date_format($d, 'Y');
        $month = (int) date_format($d, 'm');
        $day = (int) date_format($d, 'd');

        // Highseason: 20 Juni - 10 Juli
        $highseasonStart = mktime(0, 0, 0, 6, 20, $year); // Juni = 6
        $highseasonEnd = mktime(0, 0, 0, 7, 10, $year);   // Juli = 7
        $current = mktime(0, 0, 0, $month, $day, $year);

        if ($current >= $highseasonStart && $current <= $highseasonEnd) {
            return 'highseason';
        }
        // Weekend: Jumat (5) dan Sabtu (6)
        if ($dayOfWeek === 5 || $dayOfWeek === 6) {
            return 'weekend';
        }
        // Weekday: Minggu (0), Senin (1), Selasa (2), Rabu (3), Kamis (4)
        return 'weekday';
    }
}