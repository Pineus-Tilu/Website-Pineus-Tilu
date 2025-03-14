<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GetYourTrip</title>
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
            max-width: 500px;
            width: 100%;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
        }
        .btn {
            padding: 0.9rem 2.2rem;
            background: linear-gradient(to right, #2a5298, #1e3c72);
            border: none;
            border-radius: 50px;
            font-size: 1.05rem;
            color: white;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
            margin: 0.5rem;
        }
        .btn:hover {
            background: linear-gradient(to right, #3a70b0, #2a3a80);
        }
        .auth-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
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
        <h2>Explore the World with</h2>
        <h1>GetYourTrip</h1>
        <p>Discover new destinations and plan unforgettable journeys with ease.</p>
        <a href="/explore" class="btn">Explore Now</a>
        <div class="auth-links">
            <a href="/login" class="btn">Log in</a>
            <a href="/register" class="btn">Register</a>
        </div>
        <div class="footer">&copy; 2025 GetYourTrip. All Rights Reserved.</div>
    </div>
</body>
</html>
