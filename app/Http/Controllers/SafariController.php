<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Mail\BookingInquiry;
use App\Mail\CustomerConfirmation;
use App\Http\Controllers\Concerns\PreventsSpam;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    use PreventsSpam;

    public function index()
    {
        $packages = SafariPackage::latest()->get();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);
        
        return view('safari.index', compact('packages', 'allTourOptions'));
    }

    public function destinations()
    {
        $destinations = \App\Models\Destination::latest()->get();
        $categories = ['All', 'National Parks', 'Islands', 'Cultural Sites', 'Mountains'];
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        return view('destinations.index', compact('destinations', 'categories', 'allTourOptions'));
    }

    public function destinationShow($slug)
    {
        $destination = \App\Models\Destination::where('slug', $slug)->firstOrFail();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = \App\Models\SafariPackage::select('id', 'title')->get();
        $kiliTours = \App\Models\KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        // Fetch related tours (e.g., packages mentioned in destination or just some recent ones)
        $relatedTours = \App\Models\SafariPackage::latest()->take(2)->get();

        return view('destinations.show', compact('destination', 'allTourOptions', 'relatedTours'));
    }

    public function show($slug)
    {
        $package = SafariPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = SafariPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('safari.show', compact('package', 'relatedPackages'));
    }

    public function enquire(Request $request, $id)
    {
        // Silently drop bot submissions caught by the honeypot: pretend it
        // succeeded so the bot moves on, but never save or email anything.
        // Real visitors never see or fill this field, so there's no risk of
        // a genuine customer getting silently dropped here.
        if ($this->isSpamSubmission($request)) {
            $this->logSpamAttempt($request, 'honeypot');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.'
                ]);
            }
            return back()->with('success', 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.');
        }

        // Unlike the honeypot, a fast submission CAN legitimately happen (a
        // tester clicking straight through, browser autofill, a resubmit),
        // so this gets a real, visible error instead of a fake "success" —
        // otherwise the visitor believes it worked while nothing was saved.
        if ($this->isSubmittedTooFast($request)) {
            $this->logSpamAttempt($request, 'too_fast');

            $message = 'Please wait a moment and try submitting again.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->withErrors(['form' => $message])->withInput();
        }

        if (!$this->passesTurnstile($request)) {
            $this->logSpamAttempt($request, 'turnstile_failed');

            $message = 'Please complete the verification and try again.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->withErrors(['captcha' => $message])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'adults' => 'required|integer|min:1|max:50',
            'children' => 'nullable|integer|min:0|max:50',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $package = SafariPackage::findOrFail($id);

        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['name'] = trim(strip_tags($details['name']));
        $details['message'] = trim(strip_tags($details['message'] ?? ''));
        $details['package'] = $package->title;

        // 1) Save to the admin Bookings list so it never depends on email.
        try {
            \App\Models\Booking::create(array_merge([
                'safari_package_id' => $package->id,
                'tour_name'         => $package->title,
                'name'              => $details['name'],
                'email'             => $details['email'],
                'phone'             => $details['phone'] ?? null,
                'travelers'         => trim(($details['adults'] ?? 0) . ' Adults' . (!empty($details['children']) ? ', ' . $details['children'] . ' Children' : '')),
                'message'           => $details['message'] ?? null,
            ], $this->requestMeta($request)));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (safari enquire): ' . $e->getMessage(), $details);
        }

        $adminEmail = config('mail.booking_recipients');

        // 2) Notify the company inboxes (business webmail + owner's Gmail).
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
            \Log::channel('bookings')->info('Admin email sent (safari enquire)', ['to' => $adminEmail]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (safari enquire): ' . $e->getMessage(), ['to' => implode(',', (array) $adminEmail)] + $details);
        }

        // 3) Confirm to the customer.
        try {
            Mail::to($details['email'])->send(new CustomerConfirmation($details));
            \Log::channel('bookings')->info('Customer email sent (safari enquire)', ['to' => $details['email']]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Customer email failed (safari enquire): ' . $e->getMessage(), ['to' => $details['email']]);
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.'
            ]);
        }

        return back()->with('success', 'Thank you! Your safari inquiry has been received. Our team will contact you within 24 hours.');
    }

    public function storeBooking(Request $request)
    {
        // Silently drop bot submissions caught by the honeypot: pretend it
        // succeeded so the bot moves on, but never save or email anything.
        // Real visitors never see or fill this field, so there's no risk of
        // a genuine customer getting silently dropped here.
        if ($this->isSpamSubmission($request)) {
            $this->logSpamAttempt($request, 'honeypot');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your inquiry has been received. We will contact you shortly.'
                ]);
            }
            return back()->with('success', 'Thank you! Your inquiry has been received. We will contact you shortly.');
        }

        // Unlike the honeypot, a fast submission CAN legitimately happen (a
        // tester clicking straight through, browser autofill, a resubmit),
        // so this gets a real, visible error instead of a fake "success" —
        // otherwise the visitor believes it worked while nothing was saved.
        if ($this->isSubmittedTooFast($request)) {
            $this->logSpamAttempt($request, 'too_fast');

            $message = 'Please wait a moment and try submitting again.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->withErrors(['form' => $message])->withInput();
        }

        if (!$this->passesTurnstile($request)) {
            $this->logSpamAttempt($request, 'turnstile_failed');

            $message = 'Please complete the verification and try again.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->withErrors(['captcha' => $message])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name'                => 'required|string|min:2|max:255',
            'email'               => 'required|email|max:255',
            'phone_country_code'  => 'required|string|regex:/^\+[1-9][0-9]{0,3}$/',
            'phone'               => 'required|string|regex:/^[0-9]{6,14}$/',
            'tour_id'             => ['nullable', 'integer', function ($attribute, $value, $fail) {
                if ($value
                    && !SafariPackage::where('id', $value)->exists()
                    && !KilimanjaroPackage::where('id', $value)->exists()) {
                    $fail('The selected tour is invalid.');
                }
            }],
            'tour_name'           => 'nullable|string|max:255',
            'travel_date'         => 'required|date|after_or_equal:today|before:'.now()->addYears(3)->toDateString(),
            'travelers'           => ['required', Rule::in(array_merge(range(1, 10), ['11+']))],
            'accommodation'       => ['nullable', Rule::in(['luxury', 'mid_range', 'budget'])],
            'message'             => 'nullable|string|max:2000',
        ], [
            'phone_country_code.regex' => 'Please select a valid country code.',
            'phone.regex' => 'Please enter a valid phone number (digits only).',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $validated['name'] = trim(strip_tags($validated['name']));
        $validated['message'] = isset($validated['message']) ? trim(strip_tags($validated['message'])) : null;
        $validated['phone'] = $validated['phone_country_code'].$validated['phone'];
        unset($validated['phone_country_code']);

        // 1) Save to the admin Bookings list (the source of truth — never lost
        //    even if email delivery fails).
        try {
            \App\Models\Booking::create(array_merge($validated, $this->requestMeta($request)));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (store): ' . $e->getMessage(), $validated);
        }

        $details = array_merge($validated, ['package' => $validated['tour_name'] ?? 'General Inquiry']);
        $adminEmail = config('mail.booking_recipients');

        // 2) Notify the company inboxes (business webmail + owner's Gmail).
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
            \Log::channel('bookings')->info('Admin email sent (store)', ['to' => $adminEmail]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (store): ' . $e->getMessage(), ['to' => implode(',', (array) $adminEmail)] + $details);
        }

        // 3) Confirm to the customer.
        if (!empty($validated['email'])) {
            try {
                Mail::to($validated['email'])->send(new CustomerConfirmation($details));
                \Log::channel('bookings')->info('Customer email sent (store)', ['to' => $validated['email']]);
            } catch (\Throwable $e) {
                \Log::channel('bookings')->error('Customer email failed (store): ' . $e->getMessage(), ['to' => $validated['email']]);
            }
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. We will contact you shortly.'
            ]);
        }

        return back()->with('success', 'Thank you! Your inquiry has been received. We will contact you shortly.');
    }
}
