<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Reservasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #f0f0f0;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        td {
            padding: 6px;
            vertical-align: top;
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
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .payment-info {
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-style: italic;
        }

        .page-break {
            page-break-before: always;
        }

        img.logo {
            max-width: 200px;
            height: auto;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <table class="no-border">
        <tr class="no-border">
            <td class="no-border">
                <img src="{{ public_path('images/pineus_tilu_logo.png') }}" alt="Pineus Tilu" width="150">
            </td>
            <td class="text-right no-border">
                <p>Date: {{ \Carbon\Carbon::parse($booking->created_at)->format('l, d F Y') }}</p>
                <p>Invoice To: {{ $booking->customer_name }}</p>
                <p>Invoice Number: {{ $booking->invoice_number }}</p>
            </td>
        </tr>
    </table>

    {{-- Table Booking --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Amount</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total Night</th>
                <th>Unit Price</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($booking->bookingDetails as $index => $detail)
                @php
                    $area = optional($detail->facility->area)->name;
                    $deck = optional($detail->unit)->unit_name;
                    $itemName = $area . ' - ' . $deck;

                    $checkIn = \Carbon\Carbon::parse($detail->check_in);
                    $checkOut = \Carbon\Carbon::parse($detail->check_out);
                    $totalNights = $checkIn->diffInDays($checkOut);
                    if ($totalNights == 0) {
                        $totalNights = 1;
                    }

                    $unitPrice = $detail->price ?? 0;
                    $subTotal = $unitPrice * $totalNights;
                    $grandTotal += $subTotal;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $itemName }}</td>
                    <td>1</td>
                    <td>{{ $checkIn->format('d M Y') }}</td>
                    <td>{{ $checkOut->format('d M Y') }}</td>
                    <td>{{ $totalNights }}</td>
                    <td class="text-right">Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <table>
        <tr class="total-row">
            <td colspan="7" class="text-right">Total</td>
            <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
        </tr>
    </table>

    {{-- Payment Info --}}
    <p><strong>Metode Pembayaran:</strong> Transfer ke rekening:</p>
    <p>
        Bank BCA<br>
        a.n. CV. Pineus Tilu Trans<br>
        No Rek: 7710183018
    </p>

    {{-- Footer --}}
    <p class="footer">Thank you for staying with us.</p>

    {{-- Page Break --}}
    <div class="page-break"></div>

    {{-- Peraturan --}}
    <h3>PERATURAN SELAMA BERADA DI PINEUS TILU</h3>
    <p>... (Isi sesuai dokumen asli Anda)</p>

    <div class="page-break"></div>

    {{-- Ketentuan Cancel --}}
    <h3>KETENTUAN RESCHEDULE DAN CANCEL</h3>
    <p>... (Isi sesuai dokumen asli Anda)</p>

</body>

</html>
