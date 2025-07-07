<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Invoice Links</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .test-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }
        .test-link {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .test-link:hover {
            background-color: #0056b3;
        }
        .test-link.download {
            background-color: #28a745;
        }
        .test-link.download:hover {
            background-color: #1e7e34;
        }
        .test-link.pdf {
            background-color: #dc3545;
        }
        .test-link.pdf:hover {
            background-color: #c82333;
        }
        .info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice Test - Pineus Tilu</h1>
        
        <div class="info">
            <h3>Test Invoice untuk Booking ID: 1</h3>
            <p><strong>Customer:</strong> tes</p>
            <p><strong>Email:</strong> tes@gmail.com</p>
            <p><strong>Check-in:</strong> 08 Juli 2025</p>
            <p><strong>Check-out:</strong> 09 Juli 2025</p>
            <p><strong>Area:</strong> Pineus Tilu I - Deck 1</p>
            <p><strong>Total:</strong> Rp 1.100.000</p>
        </div>

        <div class="test-links">
            <a href="/booking/1" class="test-link" style="background-color: #6c757d;">
                📋 Booking Detail Page
            </a>
            <a href="/invoice/1/preview" class="test-link" target="_blank">
                📄 Preview Invoice (HTML)
            </a>
            <a href="/invoice/1" class="test-link pdf" target="_blank">
                📋 Generate PDF Invoice (Stream)
            </a>
            <a href="/invoice/1/download" class="test-link download">
                💾 Download PDF Invoice
            </a>
        </div>

        <div style="margin-top: 30px; padding: 15px; background-color: #fff3cd; border-radius: 5px;">
            <h4>Petunjuk:</h4>
            <ul>
                <li><strong>Booking Detail:</strong> Halaman detail booking dengan semua informasi dan link invoice</li>
                <li><strong>Preview:</strong> Melihat invoice dalam format HTML</li>
                <li><strong>Generate PDF:</strong> Membuka PDF invoice di browser</li>
                <li><strong>Download PDF:</strong> Mendownload file PDF invoice</li>
            </ul>
        </div>
    </div>
</body>
</html>
