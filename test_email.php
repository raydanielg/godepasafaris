<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    \Illuminate\Support\Facades\Mail::raw('This is a test email from Go Deep Africa Safari booking system.', function ($message) {
        $message->to('airezra2@gmail.com')
                ->subject('Test Email - Go Deep Africa Safari')
                ->from('app@godeepafricasafari.com', 'Go Deep Africa Safari');
    });

    echo "SUCCESS: Test email sent to airezra2@gmail.com\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
