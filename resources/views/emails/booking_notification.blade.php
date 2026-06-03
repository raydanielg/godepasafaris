<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #3E2723 0%, #8B4513 100%); padding: 30px; text-align: center; }
        .header img { max-height: 60px; }
        .content { padding: 30px; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #666; border-top: 1px solid #e0e0e0; }
        .badge { background: #8B4513; color: #fff; padding: 5px 15px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .details-table { width: 100%; margin: 20px 0; border-collapse: collapse; }
        .details-table td { padding: 12px; border-bottom: 1px solid #eee; }
        .details-table td:first-child { font-weight: 600; color: #555; width: 140px; }
        .message-box { background: #fff8f0; border-left: 4px solid #8B4513; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .button { display: inline-block; background: #8B4513; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 600; margin-top: 20px; }
        .button:hover { background: #6B3503; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari">
        </div>
        <div class="content">
            <div style="text-align: center; margin-bottom: 25px;">
                <span class="badge">New Booking Inquiry</span>
            </div>
            
            <h2 style="color: #3E2723; margin: 0 0 10px 0; font-size: 24px;">{{ $details['package'] ?? 'General Inquiry' }}</h2>
            <p style="color: #666; margin: 0 0 25px 0;">You have received a new booking inquiry from a potential traveler.</p>
            
            <table class="details-table">
                <tr><td>Customer Name</td><td>{{ $details['name'] }}</td></tr>
                <tr><td>Email Address</td><td>{{ $details['email'] }}</td></tr>
                @if(isset($details['phone']))
                <tr><td>Phone Number</td><td>{{ $details['phone'] }}</td></tr>
                @endif
                @if(isset($details['adults']))
                <tr><td>Number of Adults</td><td>{{ $details['adults'] }}</td></tr>
                @endif
                @if(isset($details['children']))
                <tr><td>Number of Children</td><td>{{ $details['children'] }}</td></tr>
                @endif
                @if(isset($details['travel_date']))
                <tr><td>Travel Date</td><td>{{ $details['travel_date'] }}</td></tr>
                @endif
                @if(isset($details['travelers']))
                <tr><td>Total Travelers</td><td>{{ $details['travelers'] }}</td></tr>
                @endif
                @if(isset($details['accommodation']))
                <tr><td>Accommodation</td><td>{{ $details['accommodation'] }}</td></tr>
                @endif
            </table>

            @if(isset($details['message']))
            <div class="message-box">
                <strong style="color: #8B4513;">Customer Message:</strong><br>
                {{ $details['message'] }}
            </div>
            @endif

            <div style="text-align: center; margin-top: 30px;">
                <a href="mailto:{{ $details['email'] }}" class="button">Reply to Customer</a>
            </div>
        </div>
        <div class="footer">
            <p style="margin: 0;">&copy; {{ date('Y') }} Go Deep Africa Safari. All Rights Reserved.</p>
            <p style="margin: 5px 0 0 0;">Arusha, Tanzania | Creating Unforgettable African Adventures</p>
        </div>
    </div>
</body>
</html>
