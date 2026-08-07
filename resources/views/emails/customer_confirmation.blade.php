<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', 'Nunito', Arial, sans-serif; color: #333; line-height: 1.6; background-color: #f4f1ec; margin: 0; padding: 0; }
        .wrap { padding: 24px 12px; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background:#fff; border-radius: 14px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #3E2723 0%, #8B4513 100%); padding: 36px 30px; text-align: center; }
        .header h1 { color:#fff; margin:14px 0 0; font-size: 26px; font-weight: 800; letter-spacing:.3px; }
        .content { padding: 34px 30px; background:#fff; }
        .badge { background:#e8f5e9; color:#2e7d32; padding: 7px 18px; border-radius: 50px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .promise { background: linear-gradient(135deg, rgba(139,69,19,.06), rgba(62,39,35,.06)); border:1px solid rgba(139,69,19,.15); border-radius: 12px; padding: 20px 22px; margin: 26px 0; }
        .promise h3 { color:#3E2723; margin: 0 0 8px; font-size: 17px; }
        .steps { margin: 22px 0; padding: 0; list-style: none; }
        .steps li { padding: 10px 0 10px 40px; position: relative; color:#4a5568; font-size: 15px; border-bottom: 1px solid #f0ece5; }
        .steps li:last-child { border-bottom: 0; }
        .stepnum { position:absolute; left:0; top:8px; width: 26px; height: 26px; background:#8B4513; color:#fff; border-radius: 50%; text-align:center; line-height:26px; font-weight:800; font-size: 13px; }
        .summary { width:100%; border-collapse: collapse; margin: 8px 0 4px; }
        .summary td { padding: 11px 12px; border-bottom: 1px solid #f0ece5; font-size: 14px; }
        .summary td:first-child { font-weight: 700; color:#6b5b4d; width: 150px; }
        .cta { text-align:center; margin: 30px 0 6px; }
        .btn { background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color:#fff !important; padding: 14px 34px; text-decoration:none; border-radius: 10px; font-weight: 800; display:inline-block; }
        .btn.wa { background: #25D366; }
        .contact { text-align:center; color:#4a5568; font-size: 14px; margin-top: 26px; }
        .contact a { color:#8B4513; text-decoration: none; font-weight: 700; }
        .footer { background:#3E2723; padding: 22px; text-align:center; font-size: 12px; color:#e8ddd4; }
        .footer a { color:#f0c9a0; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height:70px;">
            <h1>Karibu, {{ $details['name'] }}! 🦁</h1>
        </div>
        <div class="content">
            <div style="text-align:center;">
                <span class="badge">✓ Booking Received</span>
            </div>

            <p style="font-size: 16px; color:#333; margin: 22px 0 0;">
                Your safari request has landed safely with us — <strong>consider it in the hands of real Tanzanians who live for the bush.</strong>
                A dedicated safari expert has already been assigned to your trip and is looking over your details right now.
            </p>

            <div class="promise">
                <h3>⏱️ We'll be in touch within 24 hours</h3>
                <p style="margin:0; color:#4a5568; font-size:15px;">
                    Please keep an eye on your inbox (and your phone) — there's no need to look anywhere else.
                    We'll come back to you personally with a tailor-made plan and honest, transparent pricing.
                    You're already one step closer to the trip of a lifetime.
                </p>
            </div>

            <h3 style="color:#1a202c; font-size:17px; margin-bottom: 6px;">Here's what happens next</h3>
            <ul class="steps">
                <li><span class="stepnum">1</span> A safari specialist reviews your request and hand-picks the best options for you.</li>
                <li><span class="stepnum">2</span> We send you a personalised itinerary &amp; a clear quote — no hidden costs, ever.</li>
                <li><span class="stepnum">3</span> We fine-tune every detail together until it's perfect for you.</li>
                <li><span class="stepnum">4</span> You pack your bags — we handle the rest. 🌍</li>
            </ul>

            @php
                $trip = $details['package'] ?? ($details['tour_name'] ?? null);
            @endphp
            @if($trip || !empty($details['travel_date']) || !empty($details['travelers']))
            <h3 style="color:#1a202c; font-size:16px; margin: 24px 0 4px;">Your request at a glance</h3>
            <table class="summary">
                @if($trip)
                <tr><td>Interested in</td><td>{{ $trip }}</td></tr>
                @endif
                @if(!empty($details['travel_date']))
                <tr><td>Travel date</td><td>{{ $details['travel_date'] }}</td></tr>
                @endif
                @if(!empty($details['travelers']))
                <tr><td>Travellers</td><td>{{ $details['travelers'] }}</td></tr>
                @endif
            </table>
            @endif

            <div class="cta">
                <a href="https://wa.me/255794636471" class="btn wa">💬 Chat with us on WhatsApp</a>
            </div>

            <p class="contact">
                <strong>Can't wait? Talk to a human now:</strong><br>
                📞 <a href="tel:+255794636471">+255 794 636 471</a><br>
                ✉️ <a href="mailto:info@godeepafricasafari.com">info@godeepafricasafari.com</a>
            </p>
        </div>
        <div class="footer">
            <p style="margin:0 0 6px;">© {{ date('Y') }} Go Deep Africa Safari · Arusha, Tanzania</p>
            <p style="margin:0;">
                <a href="https://godeepafricasafari.com">godeepafricasafari.com</a> ·
                Creating unforgettable African adventures 🐘
            </p>
        </div>
    </div>
</div>
</body>
</html>
