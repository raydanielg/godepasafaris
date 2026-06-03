<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Nunito', sans-serif; color: #333; line-height: 1.6; background-color: #f8f9fa; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #3E2723 0%, #8B4513 100%); padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; background-color: #fff; }
        .footer { background-color: #f8f9fa; padding: 25px; text-align: center; font-size: 13px; color: #718096; border-top: 1px solid #e2e8f0; }
        .badge { background-color: #8B4513; color: #fff; padding: 8px 20px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .details-table { width: 100%; margin-top: 25px; border-collapse: collapse; }
        .details-table td { padding: 15px 12px; border-bottom: 1px solid #edf2f7; }
        .details-table td:first-child { font-weight: 600; width: 160px; color: #4a5568; }
        .highlight-box { background: linear-gradient(135deg, rgba(139, 69, 19, 0.05) 0%, rgba(62, 39, 35, 0.05) 100%); border-left: 4px solid #8B4513; padding: 20px; margin-top: 25px; border-radius: 8px; }
        .btn { background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: #fff; padding: 15px 35px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block; margin-top: 20px; }
        .social-links { margin-top: 20px; }
        .social-links a { color: #8B4513; margin: 0 10px; text-decoration: none; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height: 80px; margin-bottom: 15px;">
            <h1 style="color: #fff; margin: 0; font-size: 28px; font-weight: bold;">Thank You for Your Inquiry!</h1>
        </div>
        <div class="content">
            <div style="text-align: center; margin-bottom: 25px;">
                <span class="badge">Inquiry Received</span>
            </div>
            
            <h2 style="color: #1a202c; text-align: center; font-size: 22px; margin-bottom: 15px;">Habari {{ $details['name'] }}!</h2>
            
            <p style="color: #4a5568; font-size: 16px; text-align: center; margin-bottom: 25px;">
                Thank you for choosing <strong>Go Deep Africa Safari</strong> for your adventure! We have received your inquiry and our team is excited to help you plan an unforgettable experience.
            </p>

            <div class="highlight-box">
                <h3 style="color: #3E2723; margin-top: 0; font-size: 18px;">What Happens Next?</h3>
                <ul style="color: #4a5568; margin: 15px 0; padding-left: 20px;">
                    <li style="margin-bottom: 10px;">Our team will review your inquiry within <strong>24 hours</strong></li>
                    <li style="margin-bottom: 10px;">You'll receive a personalized response with detailed information</li>
                    <li style="margin-bottom: 10px;">We'll provide customized options based on your preferences</li>
                    <li style="margin-bottom: 0;">Our safari experts will guide you through the booking process</li>
                </ul>
            </div>

            @if(isset($details['package']))
            <table class="details-table">
                <tr><td>Tour Package</td><td>{{ $details['package'] }}</td></tr>
            </table>
            @endif

            <p style="color: #4a5568; font-size: 15px; text-align: center; margin-top: 30px;">
                <strong>Need immediate assistance?</strong><br>
                Call us: <a href="tel:+966542586758" style="color: #8B4513; text-decoration: none;">+966 54 258 6758</a><br>
                Email us: <a href="mailto:info@godeepafricasafari.com" style="color: #8B4513; text-decoration: none;">info@godeepafricasafari.com</a>
            </p>

            <div style="text-align: center;">
                <a href="https://godeepafricasafari.com" class="btn">Explore Our Tours</a>
            </div>

            <div class="social-links" style="text-align: center;">
                <a href="https://www.facebook.com/share/1DkJwJSKre/" target="_blank">Facebook</a>
                <a href="https://www.instagram.com/godeepafricasafariexpendition" target="_blank">Instagram</a>
                <a href="https://www.tiktok.com/@godeepafrica.safari" target="_blank">TikTok</a>
            </div>
        </div>
        <div class="footer">
            <p style="margin: 0 0 10px 0;">&copy; {{ date('Y') }} Go Deep Africa Safari. All Rights Reserved.</p>
            <p style="margin: 0; font-size: 12px;">Arusha, Tanzania | Creating Unforgettable African Adventures</p>
        </div>
    </div>
</body>
</html>
