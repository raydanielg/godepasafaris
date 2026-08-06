<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KilimanjaroPackage;
use App\Mail\BookingInquiry;
use App\Mail\CustomerConfirmation;
use App\Http\Controllers\Concerns\PreventsSpam;
use Illuminate\Support\Facades\Mail;

class KilimanjaroController extends Controller
{
    use PreventsSpam;

    public function index(Request $request)
    {
        $query = KilimanjaroPackage::latest();
        
        if ($request->has('all')) {
            $packages = $query->get();
        } else {
            $packages = $query->take(4)->get();
        }
        
        return view('kilimanjaro.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = KilimanjaroPackage::where('slug', $slug)->firstOrFail();
        $relatedPackages = KilimanjaroPackage::where('id', '!=', $package->id)->limit(3)->get();
        return view('kilimanjaro.show', compact('package', 'relatedPackages'));
    }

    public function routeShow($slug)
    {
        $route = [
            'slug' => $slug,
            'name' => ucfirst($slug) . ' Route',
            'title' => 'Climb Kilimanjaro via ' . ucfirst($slug) . ' Route',
            'price' => 2252,
            'days' => 7,
            'success_rate' => '93.1%',
            'overview' => 'The ' . ucfirst($slug) . ' route, also known as the Whiskey Route, is a classic Kilimanjaro trail. It’s one of the most popular routes to climb Kilimanjaro. We organize hundreds of expeditions annually along this trail that starts in a beautiful tropical forest. The Machame route is available in 6- and 7-day variations, with the second offering a significantly better acclimatization profile and summit success rate.',
        ];
        
        // In a real app, this would come from a database. 
        // For now, we'll use a static array or a dedicated view for Machame as a template.
        return view('kilimanjaro.routes.' . $slug, compact('route'));
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
                    'message' => 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.'
                ]);
            }
            return back()->with('success', 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.');
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

        $validator = \Validator::make($request->all(), [
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

        $package = KilimanjaroPackage::findOrFail($id);

        $details = $request->only(['name', 'email', 'phone', 'adults', 'children', 'message']);
        $details['name'] = trim(strip_tags($details['name']));
        $details['message'] = trim(strip_tags($details['message'] ?? ''));
        $details['package'] = $package->title;

        // 1) Save to the admin Bookings list.
        try {
            \App\Models\Booking::create(array_merge([
                'tour_name'  => $package->title,
                'name'       => $details['name'],
                'email'      => $details['email'],
                'phone'      => $details['phone'] ?? null,
                'travelers'  => trim(($details['adults'] ?? 0) . ' Adults' . (!empty($details['children']) ? ', ' . $details['children'] . ' Children' : '')),
                'message'    => $details['message'] ?? null,
            ], $this->requestMeta($request)));
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking save failed (kilimanjaro enquire): ' . $e->getMessage(), $details);
        }

        $adminEmail = config('mail.admin_address');

        // 2) Notify the company.
        try {
            Mail::to($adminEmail)->send(new BookingInquiry($details));
            \Log::channel('bookings')->info('Admin email sent (kilimanjaro enquire)', ['to' => $adminEmail]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Admin email failed (kilimanjaro enquire): ' . $e->getMessage(), ['to' => $adminEmail] + $details);
        }

        // 3) Confirm to the customer.
        try {
            Mail::to($details['email'])->send(new CustomerConfirmation($details));
            \Log::channel('bookings')->info('Customer email sent (kilimanjaro enquire)', ['to' => $details['email']]);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Customer email failed (kilimanjaro enquire): ' . $e->getMessage(), ['to' => $details['email']]);
        }

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.'
            ]);
        }

        return back()->with('success', 'Thank you! Your inquiry has been received. Our team will contact you within 24 hours.');
    }
}
