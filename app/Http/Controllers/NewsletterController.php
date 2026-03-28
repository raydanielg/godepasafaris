<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.unique' => 'You are already subscribed to our newsletter.',
        ]);

        Newsletter::create([
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Thank you for subscribing to our newsletter!']);
    }
}
