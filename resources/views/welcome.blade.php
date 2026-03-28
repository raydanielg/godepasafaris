<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Go Deep Africa Safari - Authentic Tanzania Experiences</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-earth: #8B4513;
            --secondary-earth: #A0522D;
            --accent-green: #556B2F;
            --light-earth: #DEB887;
            --dark-earth: #3E2723;
            --beige-bg: #F5F5DC;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--beige-bg);
            color: var(--dark-earth);
            margin: 0;
            overflow-x: hidden;
        }

        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1516422213484-21db3332906c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 20px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero p {
            font-size: 1.5rem;
            max-width: 800px;
            margin-bottom: 30px;
            font-weight: 600;
            color: var(--light-earth);
        }

        .nav-top {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .logo-img {
            height: 60px;
            width: auto;
        }

        .auth-nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-login {
            border: 2px solid white;
        }

        .btn-login:hover {
            background: white;
            color: var(--primary-earth);
        }

        .btn-register {
            background: var(--primary-earth);
            border: 2px solid var(--primary-earth);
        }

        .btn-register:hover {
            background: var(--dark-earth);
            border-color: var(--dark-earth);
        }

        .section-title {
            text-align: center;
            margin: 60px 0 40px;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-earth);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary-earth);
            margin: 10px auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 50px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .service-content {
            padding: 25px;
        }

        .service-content h3 {
            margin-top: 0;
            color: var(--primary-earth);
            font-weight: 800;
        }

        .service-content p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #555;
        }

        .cta-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 40px;
            background: var(--primary-earth);
            color: white;
            text-decoration: none;
            font-weight: 800;
            border-radius: 30px;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .cta-btn:hover {
            background: var(--dark-earth);
            transform: scale(1.05);
        }

        footer {
            background: var(--dark-earth);
            color: var(--beige-bg);
            padding: 40px 50px;
            text-align: center;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1.1rem; }
            .nav-top { padding: 20px; }
            .logo-img { height: 40px; }
        }
    </style>
</head>
<body>
    @include('partials.header')
    @include('partials.hero')
    @include('partials.discover')
    @include('partials.packages')
    @include('partials.styles')
    @include('partials.testimonials')
    @include('partials.blog')
    @include('partials.footer')
    @include('partials.whatsapp')
</body>
</html>
