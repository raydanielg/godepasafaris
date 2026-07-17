<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;

trait PreventsSpam
{
    /**
     * Detect automated (bot) form submissions via a hidden "honeypot" field.
     *
     * The public booking/inquiry forms include a hidden text input named
     * "website" that real visitors never see or fill. Spam bots fill in every
     * field they find, so a non-empty value here is a reliable bot signal.
     */
    protected function isSpamSubmission(Request $request): bool
    {
        return filled($request->input('website'));
    }
}
