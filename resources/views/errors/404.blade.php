<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Go Deep Africa Expedition</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-earth: #8B4513;
            --secondary-earth: #A0522D;
            --dark-earth: #3E2723;
            --beige-bg: #F5F5DC;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--beige-bg);
            color: var(--dark-earth);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        .error-code {
            font-size: 8rem;
            font-weight: 800;
            color: var(--primary-earth);
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 4px 4px 0px rgba(139, 69, 19, 0.1);
        }
        .error-icon {
            font-size: 4rem;
            color: var(--secondary-earth);
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn-home {
            display: inline-block;
            padding: 15px 40px;
            background-color: var(--primary-earth);
            color: white;
            text-decoration: none;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(139, 69, 19, 0.2);
        }
        .btn-home:hover {
            background-color: var(--dark-earth);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(139, 69, 19, 0.3);
            color: white;
        }
        .safari-decoration {
            position: absolute;
            bottom: -50px;
            width: 100%;
            height: 200px;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.05;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="error-container animate__animated animate__zoomIn">
        <div class="error-icon">
            <i class="fas fa-map-signs"></i>
        </div>
        <div class="error-code">404</div>
        <h1>Lost in the Wild?</h1>
        <p>It seems like the trail you're looking for has disappeared into the savannah. Don't worry, our guides can lead you back to safety.</p>
        <a href="/" class="btn-home">
            <i class="fas fa-home me-2"></i> RETURN TO CAMP
        </a>
    </div>
    <div class="safari-decoration"></div>
</body>
</html>
