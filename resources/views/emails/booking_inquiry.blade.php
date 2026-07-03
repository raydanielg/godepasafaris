<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Nunito', sans-serif; color: #333; line-height: 1.6; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; }
        .header { background-color: #3E2723; padding: 30px; text-align: center; }
        .content { padding: 30px; background-color: #fff; }
        .footer { background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #718096; }
        .badge { background-color: #8B4513; color: #fff; padding: 5px 15px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .details-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .details-table td { padding: 10px; border-bottom: 1px solid #edf2f7; }
        .details-table td:first-child { font-weight: bold; width: 150px; color: #4a5568; }
        .message-box { background-color: #fffaf0; border-left: 4px solid #8B4513; padding: 15px; margin-top: 20px; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Go Deep Africa Safari" style="max-height: 70px;">
        </div>
        <div class="content">
            <div style="text-align: center; margin-bottom: 20px;">
                <span class="badge">New Booking Inquiry</span>
            </div>
            <h2 style="color: #1a202c; text-align: center;">Habari! You have a new inquiry.</h2>
            <p>A potential traveler is interested in an expedition. Here are the details:</p>
            
            @php
                // Normalise traveler count across the two form shapes (general
                // booking uses "travelers"; package enquiry uses adults/children).
                $travelers = $details['travelers'] ?? null;
                if (! $travelers && (isset($details['adults']) || isset($details['children']))) {
                    $travelers = ($details['adults'] ?? 0) . ' Adults'
                        . (isset($details['children']) && $details['children'] !== '' ? ', ' . $details['children'] . ' Children' : '');
                }
            @endphp
            <table class="details-table">
                <tr><td>Full Name</td><td>{{ $details['name'] ?? '—' }}</td></tr>
                <tr><td>Email Address</td><td>{{ $details['email'] ?? '—' }}</td></tr>
                <tr><td>Phone Number</td><td>{{ $details['phone'] ?? '—' }}</td></tr>
                @if(!empty($details['package']))
                <tr><td>Package / Destination</td><td>{{ $details['package'] }}</td></tr>
                @endif
                @if(!empty($details['travel_date']))
                <tr><td>Travel Date</td><td>{{ $details['travel_date'] }}</td></tr>
                @endif
                @if($travelers)
                <tr><td>Travelers</td><td>{{ $travelers }}</td></tr>
                @endif
            </table>

            @if(!empty($details['message']))
            <div class="message-box">
                <strong>Special Requests / Message:</strong><br>
                {{ $details['message'] }}
            </div>
            @endif

            <p style="margin-top: 30px; text-align: center;">
                <a href="mailto:{{ $details['email'] }}" style="background-color: #8B4513; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;">REPLY TO TRAVELER</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Go Deep Africa Safari. All Rights Reserved.<br>
            Arusha, Tanzania | +255 794 636 471
        </div>
    </div>
</body>
</html>
