<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Go Deep Africa Safari</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #F5F5DC;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }
        .auth-container {
            display: flex;
            width: 1000px;
            max-width: 95%;
            height: 650px;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(62, 39, 35, 0.2);
        }
        .auth-sidebar {
            flex: 1.2;
            background: linear-gradient(135deg, #3E2723 0%, #8B4513 100%);
            color: #F5F5DC;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .auth-sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/dark-leather.png');
            opacity: 0.1;
        }
        .auth-sidebar h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 25px;
            border-bottom: 3px solid #DEB887;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .auth-sidebar h2 {
            font-size: 1.2rem;
            color: #DEB887;
            margin-bottom: 15px;
            font-weight: 700;
        }
        .auth-sidebar p {
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 15px;
            opacity: 0.95;
        }
        .auth-form-section {
            width: 420px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            position: relative;
        }
        .home-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #556B2F;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }
        .home-btn:hover {
            background: #3E2723;
            color: #DEB887;
            transform: translateY(-2px);
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 15px;
            margin-top: 20px;
        }
        .auth-logo img {
            width: 90px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }
        .auth-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: #3E2723;
            margin-bottom: 30px;
        }
        .form-control {
            background: #fdfdfd;
            border: 2px solid #E9ECEF;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 18px;
            transition: all 0.3s;
        }
        .form-control:focus {
            background: #fff;
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.15);
            border-color: #8B4513;
        }
        .btn-auth {
            background: #8B4513;
            color: #F5F5DC;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-weight: 800;
            border: none;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-auth:hover {
            background: #3E2723;
            transform: scale(1.02);
        }
        .auth-links {
            text-align: center;
            margin-top: 25px;
        }
        .auth-links a {
            color: #8B4513;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s;
        }
        .auth-links a:hover {
            color: #556B2F;
        }
        .auth-footer {
            margin-top: auto;
            text-align: center;
            font-size: 0.75rem;
            color: #A0522D;
            font-weight: 600;
        }
        .invalid-feedback {
            margin-top: -12px;
            margin-bottom: 12px;
            font-weight: 700;
            color: #B22222;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-sidebar">
            <h1>Go Deep Africa Safari</h1>
            <h2>Immerse in the Real Heart of Africa</h2>
            <p>
                From the snow-capped peak of <strong>Mount Kilimanjaro</strong> to the endless golden savannas of the <strong>Serengeti</strong>, we take you beyond the typical tourist paths.
            </p>
            <p>
                Experience the raw, authentic spirit of Tanzania with the experts in high-altitude expeditions and wildlife safaris. Witness the Great Migration and the majestic "Big Five" in their natural habitat.
            </p>
            <div style="margin-top: 20px; font-style: italic; color: #DEB887;">
                "Go Deep. Stay Wild. Discover Tanzania."
            </div>
        </div>
        <div class="auth-form-section">
            <a href="{{ url('/') }}" class="home-btn">
                <i class="fas fa-arrow-left"></i> GO BACK
            </a>
            
            <div class="auth-logo">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari Logo">
            </div>

            @yield('content')

            <div class="auth-footer">
                &copy; {{ date('Y') }} Go Deep Africa Safari. All Rights Reserved.
            </div>
        </div>
    </div>
</body>
</html>
