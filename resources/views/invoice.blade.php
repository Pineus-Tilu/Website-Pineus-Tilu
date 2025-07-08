<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Reservasi - Pineus Tilu</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 15mm;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9px;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table,
        th,
        td {
            border: 1px solid #999;
        }

        th {
            background-color: #2c5530;
            color: white;
            padding: 6px 4px;
            text-align: center;
            font-weight: bold;
            font-size: 8px;
            text-transform: uppercase;
        }

        td {
            padding: 5px 4px;
            vertical-align: top;
            font-size: 8px;
            background-color: #fafafa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .no-border,
        .no-border td,
        .no-border th {
            border: none !important;
            background: none !important;
        }

        .header-section {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .header-left {
            width: 50%;
            float: left;
        }

        .header-right {
            width: 50%;
            float: right;
            text-align: right;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .logo {
            max-height: 60px;
            width: auto;
        }

        .company-info {
            text-align: right;
            font-size: 8px;
            color: #666;
            line-height: 1.3;
        }

        .invoice-info {
            text-align: right;
            font-size: 8px;
            color: #2c5530;
            font-weight: bold;
        }

        .invoice-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c5530;
            text-align: center;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            margin: 10px 0 5px 0;
            text-align: center;
            color: #2c5530;
            text-transform: uppercase;
            border-bottom: 1px solid #2c5530;
            padding-bottom: 3px;
        }

        .payment-info {
            margin: 10px 0;
            padding: 12px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-style: italic;
            font-size: 8px;
            color: #666;
        }

        .page-break {
            page-break-before: always;
        }

        .rules-section {
            margin: 10px 0;
        }

        .rules-section h3 {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
            color: #2c5530;
            text-transform: uppercase;
        }

        .rules-list {
            font-size: 7px;
            line-height: 1.3;
        }

        .rules-item {
            background-color: #f0f0f0;
            padding: 4px;
            margin: 2px 0;
            border-left: 3px solid #28a745;
        }

        .rules-item-warning {
            background-color: #fff3cd;
            border-left: 3px solid #ffc107;
        }

        .rules-item-danger {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
        }

        .cancellation-policy {
            margin: 10px 0;
            font-size: 7px;
        }

        .policy-box {
            border: 1px solid #ddd;
            padding: 8px;
            margin: 5px 0;
            background-color: #fafafa;
        }

        .contact-info {
            margin: 10px 0;
            text-align: center;
            font-size: 8px;
        }

        .info-box {
            background-color: #2c5530;
            color: white;
            padding: 8px;
            text-align: center;
        }

        .two-column {
            width: 50%;
            float: left;
            padding: 0 5px;
        }
    </style>
</head>

<body>
    @php
        // Calculate nights and pricing data
        $checkIn = $booking->bookingDetail
            ? \Carbon\Carbon::parse($booking->bookingDetail->check_in)
            : \Carbon\Carbon::now();
        $checkOut = $booking->bookingDetail
            ? \Carbon\Carbon::parse($booking->bookingDetail->check_out)
            : \Carbon\Carbon::now()->addDay();
        $nights = $checkIn->diffInDays($checkOut);
        if ($nights == 0) {
            $nights = 1;
        }

        $basePrice = $booking->bookingDetail
            ? $booking->bookingDetail->total_price - ($booking->bookingDetail->extra_charge ?? 0)
            : 0;
        $unitPrice = $nights > 0 ? $basePrice / $nights : $basePrice;
        $extraCharge = $booking->bookingDetail->extra_charge ?? 0;
        $subTotal = $booking->bookingDetail->total_price ?? 0;

        // Determine price type
        $priceType = 'weekday';
        $dayOfWeek = $checkIn->dayOfWeek;
        if ($dayOfWeek == 5 || $dayOfWeek == 6) {
            $priceType = 'weekend';
        }

        // Invoice number
        $invoiceNumber =
            $booking->payment->order_id ??
            ($booking->invoice_number ?? 'INV-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT));
    @endphp

    {{-- HALAMAN 1: INVOICE UTAMA --}}
    {{-- Header --}}
    <div class="clearfix header-section">
        <div class="header-left">
            <img src="{{ public_path('images/pineus_tilu_logo.png') }}" alt="Pineus Tilu Riverside" class="logo">
        </div>
        <div class="header-right invoice-info">
            <p style="margin: 2px 0; font-size: 8px;"><strong>Date :</strong> {{ $booking->created_at->format('d F Y') }}
            </p>
            <p style="margin: 2px 0; font-size: 8px;"><strong>Invoice to :</strong>
                {{ $booking->bookingDetail->nama ?? ($booking->user->name ?? 'Guest') }}</p>
            <p style="margin: 2px 0; font-size: 8px;"><strong>Invoice Number :</strong> {{ $invoiceNumber }}</p>
        </div>
    </div>

    {{-- Invoice Title --}}
    <div class="invoice-title">INVOICE RESERVATION</div>

    {{-- Detail Reservasi --}}
    <div class="section-title">Detail Reservasi</div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Nama Pemesan</th>
                <th style="width: 12%;">No Telepon</th>
                <th style="width: 18%;">Email</th>
                <th style="width: 10%;">Area</th>
                <th style="width: 8%;">Deck</th>
                <th style="width: 10%;">Check-in</th>
                <th style="width: 10%;">Check-out</th>
                <th style="width: 8%;">Malam</th>
                <th style="width: 9%;">Tamu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->bookingDetail->nama ?? ($booking->user->name ?? 'Guest') }}</td>
                <td>{{ $booking->bookingDetail->telepon ?? ($booking->user->phone ?? '-') }}</td>
                <td>{{ $booking->bookingDetail->email ?? ($booking->user->email ?? '-') }}</td>
                <td>{{ $booking->unit->area->name ?? 'N/A' }}</td>
                <td>{{ $booking->unit->unit_name ?? 'N/A' }}</td>
                <td>{{ $checkIn->format('d M Y') }}</td>
                <td>{{ $checkOut->format('d M Y') }}</td>
                <td class="text-center">{{ $nights }}</td>
                <td class="text-center">{{ $booking->bookingDetail->number_of_people ?? 1 }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Detail Pembayaran --}}
    <div class="section-title">Detail Pembayaran</div>

    <table>
        <thead>
            <tr>
                <th style="width: 50%;">Keterangan</th>
                <th style="width: 10%;">Qty</th>
                <th style="width: 20%;">Unit Price</th>
                <th style="width: 10%;">Extra Charge</th>
                <th style="width: 10%;">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Harga Dasar - {{ $booking->unit->area->name ?? 'Area' }} {{ $booking->unit->unit_name ?? 'Deck' }}
                    ({{ $priceType }}, {{ $nights }} malam)</td>
                <td class="text-center">{{ $nights }}</td>
                <td class="text-right">Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($extraCharge, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Total --}}
    <table>
        <thead>
            <tr>
                <th colspan="4" class="text-right"
                    style="font-size: 9px; font-weight: bold; background-color: #2c5530; color: white;">TOTAL</th>
                <th class="text-right"
                    style="font-size: 9px; font-weight: bold; background-color: #2c5530; color: white;">Rp
                    {{ number_format($subTotal, 0, ',', '.') }}</th>
            </tr>
        </thead>
    </table>

    {{-- Informasi Pembayaran --}}
    <div class="payment-info">
        <h4
            style="margin: 0 0 8px 0; font-size: 10px; color: #2c5530; border-bottom: 1px solid #2c5530; padding-bottom: 3px; font-weight: bold; text-transform: uppercase;">
            Informasi Pembayaran</h4>
        <table class="no-border" style="width: 100%; font-size: 8px;">
            <tr>
                <td style="width: 60%; vertical-align: top; padding: 5px;">
                    <table class="no-border" style="width: 100%;">
                        <tr>
                            <td class="no-border" style="width: 35%; font-weight: bold;">Status Pembayaran :</td>
                            <td class="no-border">
                                @if ($booking->payment)
                                    {{ ucfirst($booking->payment->transaction_status) }}
                                @else
                                    {{ $booking->status->name ?? 'Pending' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="no-border" style="font-weight: bold;">Order Id :</td>
                            <td class="no-border">{{ $invoiceNumber }}</td>
                        </tr>
                        <tr>
                            <td class="no-border" style="font-weight: bold;">Metode pembayaran :</td>
                            <td class="no-border">
                                @if ($booking->payment && $booking->payment->payment_type)
                                    {{ ucwords(str_replace('_', ' ', $booking->payment->payment_type)) }}
                                @else
                                    Transfer Bank
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="no-border" style="font-weight: bold;">Total Dibayar :</td>
                            <td class="no-border" style="color: #2c5530; font-weight: bold;">Rp
                                {{ number_format($booking->payment->gross_amount ?? $subTotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="no-border" style="font-weight: bold;">Tanggal Pembayaran :</td>
                            <td class="no-border">
                                @if ($booking->payment && in_array($booking->payment->transaction_status, ['settlement', 'capture']))
                                    {{ $booking->payment->updated_at->format('d F Y') }}
                                @else
                                    {{ $booking->updated_at->format('d F Y') }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 40%; text-align: right; vertical-align: top; padding: 5px;">
                    <p style="margin: 0; font-size: 8px; font-weight: bold; color: #2c5530;">Bandung,
                        {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    <p style="margin: 10px 0 0 0; font-size: 7px; color: #666;">prepared by</p>
                    <br><br>
                    <p style="margin: 0; font-size: 8px; font-weight: bold; color: #2c5530;">Pineus Tilu</p>
                    <div style="border-top: 1px solid #2c5530; width: 100px; margin: 3px 0 0 auto;"></div>
                    <p style="margin: 3px 0 0 0; font-size: 7px; color: #666;">Management</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- Contact Info --}}
    <div class="contact-info">
        <div class="info-box">
            <p style="margin: 0; font-size: 9px; font-weight: bold;">INFORMASI TRANSFER</p>
            <p style="margin: 3px 0 0 0; font-size: 8px;">Bank BCA | a.n. CV. Pineus Tilu Trans | No Rek:
                <strong>7710183018</strong></p>
        </div>
    </div>

    {{-- Footer --}}
    <p class="footer">Thank you for staying with us at Pineus Tilu Riverside.</p>

    {{-- Page Break --}}
    <div class="page-break"></div>

    {{-- HALAMAN 2: PERATURAN --}}
    {{-- Header halaman 2 --}}
    <div class="clearfix header-section">
        <div class="header-left">
            <img src="{{ public_path('images/pineus_tilu_logo.png') }}" alt="Pineus Tilu Riverside"
                style="max-height: 50px; width: auto;">
        </div>
        <div class="header-right invoice-info">
            <p style="margin: 2px 0; font-size: 7px;">Invoice No: {{ $invoiceNumber }}</p>
            <p style="margin: 2px 0; font-size: 7px;">Page 2 of 3</p>
        </div>
    </div>

    {{-- Peraturan --}}
    <div class="rules-section">
        <h3 style="color: #2c5530; border-bottom: 2px solid #2c5530; padding-bottom: 10px;">PERATURAN SELAMA BERADA DI
            PINEUS TILU</h3>
        <p style="text-align: center; font-style: italic; margin-bottom: 20px; color: #666;">ENGLISH VERSION</p>

        <div class="rules-list">
            <div class="clearfix">
                <div class="two-column">
                    <div class="rules-item">
                        <strong>Waktu Check In:</strong> Paling cepat pukul 14.00 WIB<br>
                        <strong>Check In Time:</strong> The earliest at 14.00 WIB
                    </div>
                    <div class="rules-item">
                        <strong>Waktu Check Out:</strong> Maksimal pukul 12.00 WIB<br>
                        <strong>Check Out Time:</strong> Maximum at 12.00 WIB
                    </div>
                    <div class="rules-item">
                        <strong>Kebersihan:</strong> Menjaga kebersihan lingkungan<br>
                        <strong>Keep the environment clean</strong>
                    </div>
                    <div class="rules-item">
                        <strong>Sampah:</strong> Memilah sampah organik dan anorganik<br>
                        <strong>Sorting organic and inorganic waste</strong>
                    </div>
                    <div class="rules-item">
                        <strong>Merokok:</strong> Pada tempat yang sudah disediakan<br>
                        <strong>Smoking at designated areas provided</strong>
                    </div>
                    <div class="rules-item">
                        <strong>Barang Pribadi:</strong> Menjaga barang pribadi masing-masing<br>
                        <strong>Taking care of personal belongings</strong>
                    </div>
                </div>
                <div class="two-column">
                    <div class="rules-item rules-item-warning">
                        <strong>Kegiatan Amoral:</strong> Dilarang melakukan kegiatan amoral<br>
                        <strong>Do not engage in immoral activities</strong>
                    </div>
                    <div class="rules-item rules-item-warning">
                        <strong>Anjing:</strong> Dilarang membawa anjing<br>
                        <strong>Do not bring dogs</strong>
                    </div>
                    <div class="rules-item rules-item-warning">
                        <strong>BBQ:</strong> Dilarang memakan daging babi setelah BBQ<br>
                        <strong>Forbidden to cook pork on BBQ</strong>
                    </div>
                    <div class="rules-item rules-item-warning">
                        <strong>Speaker:</strong> Tidak boleh ada speaker suara<br>
                        <strong>No loudspeakers or speakers</strong>
                    </div>
                    <div class="rules-item rules-item-warning">
                        <strong>Musik:</strong> Hanya terdengar di tenda sendiri<br>
                        <strong>Music only heard in own tent</strong>
                    </div>
                    <div class="rules-item rules-item-danger">
                        <strong>Force Majeure:</strong> Jika terpaksa tutup, refund dipotong 50%<br>
                        <strong>If forced to close, refund reduced 50%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- HALAMAN 3: KETENTUAN PEMBATALAN --}}
    <div class="page-break"></div>

    {{-- Header halaman 3 --}}
    <div class="clearfix header-section">
        <div class="header-left">
            <img src="{{ public_path('images/pineus_tilu_logo.png') }}" alt="Pineus Tilu Riverside"
                style="max-height: 50px; width: auto;">
        </div>
        <div class="header-right invoice-info">
            <p style="margin: 2px 0; font-size: 7px;">Invoice No: {{ $invoiceNumber }}</p>
            <p style="margin: 2px 0; font-size: 7px;">Page 3 of 3</p>
        </div>
    </div>

    {{-- Ketentuan Cancel --}}
    <div class="rules-section">
        <h3 style="color: #2c5530; border-bottom: 2px solid #2c5530; padding-bottom: 10px;">KETENTUAN PEMBATALAN</h3>
        <p style="text-align: center; font-style: italic; margin-bottom: 20px; color: #666;">ENGLISH VERSION</p>

        <div class="cancellation-policy">
            <h4 style="text-align: center; margin: 15px 0; color: #2c5530; font-size: 10px;">KETENTUAN PEMBATALAN
                BERLAKU PER TENDA</h4>
            <p style="text-align: center; font-style: italic; margin-bottom: 15px; color: #666; font-size: 7px;">
                CANCELLATION TERMS APPLY PER TENT</p>

            <div class="clearfix">
                <div class="two-column">
                    <div class="policy-box" style="border-left: 3px solid #dc3545;">
                        <h5
                            style="color: #dc3545; text-align: center; margin-bottom: 8px; font-size: 8px; text-transform: uppercase;">
                            BAHASA INDONESIA</h5>
                        <p style="margin: 3px 0; font-weight: bold; color: #dc3545; font-size: 7px;">Di luar H-7
                            tanggal check-in = Potongan 25%</p>
                        <p style="margin: 3px 0; font-weight: bold; color: #dc3545; font-size: 7px;">Terhitung H-7
                            hingga H-4 = Potongan 50%</p>
                        <p style="margin: 3px 0; font-weight: bold; color: #dc3545; font-size: 7px;">Terhitung H-3
                            hingga H-2 = Potongan 75%</p>
                        <p style="margin: 3px 0; font-weight: bold; color: #dc3545; font-size: 7px;">Terhitung H-1
                            hingga H = Potongan 100%</p>
                    </div>
                </div>
                <div class="two-column">
                    <div class="policy-box" style="border-left: 3px solid #007bff;">
                        <h5
                            style="color: #007bff; text-align: center; margin-bottom: 8px; font-size: 8px; text-transform: uppercase;">
                            ENGLISH VERSION</h5>
                        <p style="margin: 3px 0; color: #007bff; font-weight: bold; font-size: 7px;">Before D-7
                            check-in date = Cut 25%</p>
                        <p style="margin: 3px 0; color: #007bff; font-weight: bold; font-size: 7px;">Counting D-7 to
                            D-4 = Cut 50%</p>
                        <p style="margin: 3px 0; color: #007bff; font-weight: bold; font-size: 7px;">Counting D-3 to
                            D-2 = Cut 75%</p>
                        <p style="margin: 3px 0; color: #007bff; font-weight: bold; font-size: 7px;">Counting D-1 to D
                            day = Cut 100%</p>
                    </div>
                </div>
            </div>

            <div style="margin: 15px 0;">
                <h4
                    style="text-align: center; color: #2c5530; background-color: #f8f9fa; padding: 5px; font-size: 9px; text-transform: uppercase;">
                    PENGAJUAN PEMBATALAN</h4>
                <p style="text-align: center; font-style: italic; margin-bottom: 10px; color: #666; font-size: 7px;">
                    CANCELLATION REQUEST</p>

                <div class="clearfix">
                    <div
                        style="width: 65%; float: left; background-color: #f8f9fa; padding: 8px; border-left: 3px solid #28a745;">
                        <h5 style="color: #28a745; margin-bottom: 5px; font-size: 7px; font-weight: bold;">PEMBATALAN
                            DAPAT DILAKUKAN DENGAN MENGHUBUNGI ADMIN WHATSAPP PINEUS TILU</h5>
                        <p style="font-style: italic; color: #666; margin: 2px 0; font-size: 6px;">Cancellation can be
                            made by contacting Pineus Tilu WhatsApp admin</p>
                        <p style="margin: 5px 0; font-weight: bold; font-size: 7px;">WhatsApp: +62 812-3456-7890</p>
                    </div>
                    <div
                        style="width: 30%; float: right; background-color: #fff3cd; padding: 8px; border-left: 3px solid #ffc107;">
                        <h5 style="color: #856404; margin-bottom: 5px; font-size: 7px; font-weight: bold;">JAM
                            OPERASIONAL:</h5>
                        <p style="font-style: italic; color: #666; margin: 2px 0; font-size: 6px;">OPERATING HOURS</p>
                        <p style="margin: 5px 0; font-weight: bold; font-size: 8px;">08:00 - 17:00 WIB</p>
                        <p style="margin: 2px 0; font-size: 6px; color: #666;">Senin - Minggu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer untuk halaman terakhir --}}
    <div style="margin-top: 40px; text-align: center; padding-top: 20px; border-top: 1px solid #ddd;">
        <p style="margin: 5px 0; font-size: 11px; color: #666;">CV. Pineus Tilu Trans</p>
        <p style="margin: 5px 0; font-size: 10px; color: #666;">Jl. Raya Pangalengan, Rahong, Pangalengan, Bandung,
            Jawa Barat</p>
        <p style="margin: 5px 0; font-size: 10px; font-style: italic;">Thank you for choosing Pineus Tilu Riverside</p>
    </div>

</body>

</html>
