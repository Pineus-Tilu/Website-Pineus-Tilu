<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore - GetYourTrip</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #2b2a6e, #16222A, #3a6073);
            color: white;
            padding: 1rem;
        }
        .container {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }
        h2 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .card {
            background: rgba(255, 255, 255, 0.07);
            padding: 1.2rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, background 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
        }
        .card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: white;
        }
        .card p {
            font-size: 0.95rem;
            color: #ccc;
        }
        .btn {
            padding: 0.8rem 2rem;
            background: linear-gradient(to right, #2a5298, #1e3c72);
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
            margin: 0.5rem;
            display: inline-block;
        }
        .btn:hover {
            background: linear-gradient(to right, #3a70b0, #2a3a80);
        }
        .footer {
            font-size: 0.85rem;
            margin-top: 2rem;
            color: #cccccc;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Explore Destinasi</h1>
        <h2>Temukan berbagai inspirasi perjalananmu di GetYourTrip</h2>

        <div class="card-container">
            <div class="card">
                <h3>Pantai Tropis</h3>
                <p>Nikmati keindahan pasir putih dan ombak biru yang menenangkan.</p>
            </div>
            <div class="card">
                <h3>Gunung & Alam</h3>
                <p>Jelajahi pegunungan dan hutan tropis yang mempesona.</p>
            </div>
            <div class="card">
                <h3>Kota Bersejarah</h3>
                <p>Kenali budaya lokal dari kota-kota kuno yang kaya akan sejarah.</p>
            </div>
            <div class="card">
                <h3>Paket Keluarga</h3>
                <p>Liburan seru bersama keluarga dengan destinasi yang ramah anak.</p>
            </div>
        </div>

        <a href="/tour-redirect" onclick="return showLoginAlert()" class="btn">Lihat Semua Paket</a>

        <div class="footer">&copy; 2025 GetYourTrip. All Rights Reserved.</div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showLoginAlert() {
            const notLoggedIn = {{ Auth::check() ? 'false' : 'true' }};
            
            if (notLoggedIn) {
                Swal.fire({
                    title: 'Login Diperlukan',
                    text: 'Silakan login terlebih dahulu untuk melihat semua paket wisata.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/";
                    }
                });

                return false; // prevent default link behavior
            }

            return true; // allow link to proceed
        }
    </script>
</body>
</html>
