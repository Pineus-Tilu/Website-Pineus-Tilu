<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use App\Models\AreaUnit;
use App\Models\Area;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function detailPembelian(Request $request)
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
        ]);

        // Cari unit_id berdasarkan area (fasilitas) dan deck
        $unit = AreaUnit::whereHas('facility.area', function($q) use ($request) {
                $q->where('name', $request->fasilitas);
            })
            ->where('unit_name', $request->deck)
            ->first();

        if (!$unit) {
            return back()->withErrors(['deck' => 'Deck tidak ditemukan.']);
        }

        // Validasi tanggal sudah dipesan
        $sudahDipesan = Booking::where('unit_id', $unit->id)
            ->where('booking_for_date', $request->tanggal_kunjungan)
            ->exists();

        if ($sudahDipesan) {
            return back()->withErrors(['tanggal_kunjungan' => 'Tanggal ini sudah dipesan untuk deck tersebut. Silakan pilih tanggal lain.'])->withInput();
        }

        // Ambil harga dan data terkait
        $price = Price::where('unit_id', $unit->id)->first();
        $area = Area::find($unit->facility->area_id);

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

        // Simpan ke tabel bookings
        $booking = Booking::create([
            'user_id' => null,
            'unit_id' => $unit->id,
            'booking_for_date' => $tanggal,
        ]);

        // Simpan ke tabel booking_details
        $bookingDetail = BookingDetail::create([
            'booking_id' => $booking->id,
            'number_of_people' => $jumlah,
            'extra_charge' => $extra,
            'notes' => null,
            'total_price' => $total,
            'check_in' => $tanggal,
            'check_out' => $checkout, // <-- checkout = hari esok setelah checkin
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        // Redirect ke halaman detail pembelian dengan data booking
        return view('detailpembelian', [
            'booking' => $booking,
            'bookingDetail' => $bookingDetail,
            'tanggal_kunjungan' => $tanggal,
            'fasilitas' => $request->fasilitas,
            'deck' => $request->deck ?? '-',
            'jumlah_orang' => $jumlah,
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'subtotal' => $total,
        ]);
    }

    // Tambahkan fungsi bantu season:
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

    public function showReservasi()
    {
        $areas = Area::all();
        $areaUnits = AreaUnit::with('facility.area')->get()->groupBy(function($unit) {
            return $unit->facility->area->name;
        });

        $prices = [];
        $bookedDates = [];

        foreach ($areaUnits as $areaName => $units) {
            foreach ($units as $unit) {
                $price = Price::where('unit_id', $unit->id)->first();
                $area = Area::find($unit->facility->area_id);
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
                // Ambil tanggal yang sudah dipesan untuk unit ini, pastikan format string Y-m-d
                $bookedDates[$unit->unit_name] = Booking::where('unit_id', $unit->id)
                    ->pluck('booking_for_date')
                    ->map(fn($d) => date('Y-m-d', strtotime($d)))
                    ->toArray();
            }
        }

        return view('reservasi', [
            'prices' => $prices,
            'areaUnits' => $areaUnits,
            'areas' => $areas,
            'bookedDates' => $bookedDates,
        ]);
    }
}
