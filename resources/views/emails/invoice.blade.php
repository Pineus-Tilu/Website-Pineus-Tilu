<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Pineus Tilu Riverside</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #2c5530; margin-bottom: 10px;">Pineus Tilu Riverside</h1>
        <p style="color: #666; margin: 0;">Terima kasih atas pembayaran Anda!</p>
    </div>

    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2 style="color: #2c5530; margin-top: 0;">Detail Pembayaran Berhasil</h2>
        <p>Halo <strong>{{ $booking->bookingDetail->nama ?? $booking->user->name ?? 'Customer' }}</strong>,</p>
        <p>Pembayaran untuk reservasi Anda telah berhasil diproses. Berikut adalah detail pemesanan Anda:</p>
        
        <table style="width: 100%; border-collapse: collapse; margin: 15px 0;">
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;"><strong>Nomor Booking:</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">{{ $booking->id }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;"><strong>Tanggal Kunjungan:</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">{{ \Carbon\Carbon::parse($booking->bookingDetail->check_in ?? $booking->booking_for_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;"><strong>Lokasi:</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">{{ $booking->unit->area->name ?? 'Area Wisata' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;"><strong>Jumlah Pengunjung:</strong></td>
                <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">{{ $booking->bookingDetail->number_of_people ?? 1 }} orang</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Total Pembayaran:</strong></td>
                <td style="padding: 8px 0; color: #2c5530; font-weight: bold;">Rp {{ number_format($booking->total_amount ?? $booking->bookingDetail->total_price ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div style="background-color: #e8f5e8; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <p style="margin: 0; color: #2c5530;"><strong>📄 Invoice terlampir</strong></p>
        <p style="margin: 5px 0 0 0; font-size: 14px;">Invoice lengkap beserta syarat dan ketentuan telah dilampirkan dalam email ini dalam format PDF.</p>
    </div>

    <div style="margin-bottom: 20px;">
        <h3 style="color: #2c5530;">Informasi Penting:</h3>
        <ul style="padding-left: 20px;">
            <li>Harap tunjukkan invoice ini saat check-in</li>
            <li>Datang 15 menit sebelum waktu kunjungan</li>
            <li>Bawa identitas yang valid untuk verifikasi</li>
            <li>Hubungi kami jika ada pertanyaan atau perubahan jadwal</li>
        </ul>
    </div>

    <div style="text-align: center; padding: 20px; border-top: 2px solid #2c5530; margin-top: 30px;">
        <p style="margin: 0; color: #666;">Pineus Tilu Riverside</p>
        <p style="margin: 5px 0; color: #666;">Jl. Raya Ciater, Subang, Jawa Barat</p>
        <p style="margin: 5px 0; color: #666;">WhatsApp: +62 812-3456-7890 | Email: info@pineustilu.com</p>
    </div>

    <div style="text-align: center; margin-top: 20px; font-size: 12px; color: #999;">
        <p>Email ini dikirim otomatis. Harap tidak membalas email ini.</p>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi customer service kami.</p>
    </div>
</body>
</html>
