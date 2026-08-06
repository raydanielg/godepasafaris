<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\Destination;
use App\Models\User;
use App\Models\Post;
use App\Models\Announcement;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => \App\Models\Booking::count(),
            'safari_packages' => \App\Models\SafariPackage::count(),
            'kili_packages' => \App\Models\KilimanjaroPackage::count(),
            'total_destinations' => \App\Models\Destination::count(),
            'total_users' => \App\Models\User::count(),
            'total_posts' => \App\Models\Post::count(),
        ];

        $recentBookings = \App\Models\Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function deleteAccount()
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return redirect('/')->with('success', 'Your account has been successfully deleted.');
    }

    public function destinations()
    {
        $destinations = \App\Models\Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function bookings()
    {
        $bookings = \App\Models\Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function safariPackages()
    {
        $packages = \App\Models\SafariPackage::latest()->paginate(10);
        return view('admin.safaris.index', compact('packages'));
    }

    public function kiliPackages()
    {
        $packages = \App\Models\KilimanjaroPackage::latest()->paginate(10);
        return view('admin.kilimanjaro.index', compact('packages'));
    }

    public function posts()
    {
        $posts = \App\Models\Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function createPost()
    {
        return view('admin.posts.create');
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        \App\Models\Post::create($data);

        return redirect()->route('admin.posts')->with('success', 'Blog post created successfully.');
    }

    public function editPost(\App\Models\Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        $post->update($data);

        return redirect()->route('admin.posts')->with('success', 'Blog post updated successfully.');
    }

    public function deletePost(\App\Models\Post $post)
    {
        $post->delete();
        return back()->with('success', 'Blog post deleted successfully.');
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . Str::random(20) . '.' . $file->extension();
        $file->move(public_path('images/blog/content'), $filename);
        return response()->json(['location' => asset('images/blog/content/' . $filename)]);
    }

    public function createSafari()
    {
        return view('admin.safaris.create');
    }

    public function storeSafari(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'currency' => 'nullable|string',
            'days' => 'nullable|integer',
            'group_discount' => 'nullable|numeric',
            'min_group_size' => 'nullable|integer',
            'category' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        
        // Handle boolean fields
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active') ? $request->is_active : true;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/safaris'), $imageName);
            $data['image'] = 'images/safaris/' . $imageName;
        }

        \App\Models\SafariPackage::create($data);

        return redirect()->route('admin.safaris')->with('success', 'Safari package created successfully.');
    }

    public function editSafari(\App\Models\SafariPackage $package)
    {
        return view('admin.safaris.edit', compact('package'));
    }

    public function updateSafari(Request $request, \App\Models\SafariPackage $package)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'currency' => 'nullable|string',
            'days' => 'nullable|integer',
            'group_discount' => 'nullable|numeric',
            'min_group_size' => 'nullable|integer',
            'category' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        
        // Get existing columns from database
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing('safari_packages');
        
        // Only include fields that exist in the database
        $data = array_filter($data, function($key) use ($columns) {
            return in_array($key, $columns) || in_array($key, ['_token', '_method']);
        }, ARRAY_FILTER_USE_KEY);
        
        // Preserve existing data if empty or not in request
        if (in_array('itinerary', $columns)) {
            if (!$request->has('itinerary') || trim($request->itinerary) === '') {
                $data['itinerary'] = $package->itinerary;
            }
        }
        if (in_array('inclusions', $columns)) {
            if (!$request->has('inclusions') || trim($request->inclusions) === '') {
                $data['inclusions'] = $package->inclusions;
            }
        }
        if (in_array('exclusions', $columns)) {
            if (!$request->has('exclusions') || trim($request->exclusions) === '') {
                $data['exclusions'] = $package->exclusions;
            }
        }
        if (in_array('description', $columns)) {
            if (!$request->has('description') || trim($request->description) === '') {
                $data['description'] = $package->description;
            }
        }
        
        // Handle boolean fields only if they exist in database
        if (in_array('is_featured', $columns)) {
            $data['is_featured'] = $request->has('is_featured');
        }
        if (in_array('is_active', $columns)) {
            $data['is_active'] = $request->has('is_active') ? $request->is_active : true;
        }

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/safaris'), $imageName);
            $data['image'] = 'images/safaris/' . $imageName;
        }

        $package->update($data);

        return redirect()->route('admin.safaris')->with('success', 'Safari package updated successfully.');
    }

    public function deleteSafari(\App\Models\SafariPackage $package, Request $request)
    {
        $package->delete();
        
        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Safari package deleted successfully.'
            ]);
        }
        
        return back()->with('success', 'Safari package deleted successfully.');
    }

    /**
     * Duplicate a package as an inactive draft so admins can build variants fast
     * without re-entering everything. Copies every field; the slug is made unique.
     */
    public function duplicateSafari(\App\Models\SafariPackage $package)
    {
        $copy = $package->replicate();
        $copy->title = $package->title . ' (Copy)';
        $copy->slug = \Illuminate\Support\Str::slug($copy->title) . '-' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(5));
        $copy->is_featured = false;
        $copy->is_active = false; // start as a draft
        $copy->save();

        return redirect()->route('admin.safaris.edit', $copy)
            ->with('success', 'Package duplicated as a draft. Review the details and switch it to Active when ready.');
    }

    public function createKili()
    {
        return view('admin.kilimanjaro.create');
    }

    public function storeKili(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'days' => 'required|integer',
            'route_name' => 'required|string',
            'description' => 'required|string',
            'itinerary' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/kilimanjaro'), $imageName);
            $data['image'] = 'images/kilimanjaro/' . $imageName;
        }

        \App\Models\KilimanjaroPackage::create($data);

        return redirect()->route('admin.kilimanjaro')->with('success', 'Kilimanjaro package created successfully.');
    }

    public function editKili(\App\Models\KilimanjaroPackage $package)
    {
        return view('admin.kilimanjaro.edit', compact('package'));
    }

    public function updateKili(Request $request, \App\Models\KilimanjaroPackage $package)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'days' => 'required|integer',
            'route_name' => 'required|string',
            'description' => 'required|string',
            'itinerary' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/kilimanjaro'), $imageName);
            $data['image'] = 'images/kilimanjaro/' . $imageName;
        }

        $package->update($data);

        return redirect()->route('admin.kilimanjaro')->with('success', 'Kilimanjaro package updated successfully.');
    }

    public function deleteKili(\App\Models\KilimanjaroPackage $package)
    {
        $package->delete();
        return back()->with('success', 'Kilimanjaro package deleted successfully.');
    }

    public function createDestination()
    {
        return view('admin.destinations.create');
    }

    public function storeDestination(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rich_content' => 'nullable|string',
            'rate_range' => 'nullable|string|max:255',
            'best_time' => 'nullable|string|max:255',
            'high_season' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'map_iframe' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(20) . '.' . $file->extension();
            $file->move(public_path('images/destinations'), $filename);
            $data['image'] = 'images/destinations/' . $filename;
        }

        Destination::create($data);

        return redirect()->route('admin.destinations')->with('success', 'Destination created successfully');
    }

    public function editDestination(\App\Models\Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function updateDestination(Request $request, \App\Models\Destination $destination)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rich_content' => 'nullable|string',
            'rate_range' => 'nullable|string|max:255',
            'best_time' => 'nullable|string|max:255',
            'high_season' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'map_iframe' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($destination->image && file_exists(public_path($destination->image))) {
                unlink(public_path($destination->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(20) . '.' . $file->extension();
            $file->move(public_path('images/destinations'), $filename);
            $data['image'] = 'images/destinations/' . $filename;
        }

        $destination->update($data);

        return redirect()->route('admin.destinations')->with('success', 'Destination updated successfully');
    }

    public function deleteDestination(\App\Models\Destination $destination)
    {
        $destination->delete();
        return back()->with('success', 'Destination deleted successfully.');
    }

    public function viewBooking(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function deleteBooking(Booking $booking, Request $request)
    {
        \App\Models\BookingActivityLog::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'description' => "Deleted inquiry from {$booking->name} ({$booking->email})",
        ]);

        $booking->delete();

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Inquiry deleted successfully.'
            ]);
        }
        
        return redirect()->route('admin.bookings')->with('success', 'Inquiry deleted successfully.');
    }

    /**
     * Delete every booking/inquiry in one click. Keeps the ID counter where it
     * is (use restartBookingSystem() for a full reset). Admin-only via the
     * `auth` middleware + CSRF; the UI adds a type-to-confirm guard.
     */
    public function deleteAllBookings(Request $request)
    {
        $count = Booking::count();

        Booking::query()->delete();

        \Log::channel('bookings')->warning('All bookings cleared by admin', [
            'admin_id' => auth()->id(),
            'deleted'  => $count,
        ]);

        $message = $count > 0
            ? "Deleted {$count} booking(s) successfully."
            : 'There were no bookings to delete.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $message, 'deleted' => $count]);
        }

        return redirect()->route('admin.bookings')->with('success', $message);
    }

    /**
     * Restart the booking system: wipe every booking, reset the ID counter so
     * the next booking is #1, and clear the bookings log. A true fresh start.
     * Works on both MySQL/MariaDB (live) and SQLite (local/tests).
     */
    public function restartBookingSystem(Request $request)
    {
        $count = Booking::count();

        // 1) Remove all bookings.
        Booking::query()->delete();

        // 2) Reset the auto-increment so the next booking starts at #1.
        try {
            $driver = \DB::connection()->getDriverName();

            if ($driver === 'sqlite') {
                \DB::statement("DELETE FROM sqlite_sequence WHERE name = 'bookings'");
            } elseif (in_array($driver, ['mysql', 'mariadb'], true)) {
                \DB::statement('ALTER TABLE bookings AUTO_INCREMENT = 1');
            } elseif ($driver === 'pgsql') {
                \DB::statement('ALTER SEQUENCE bookings_id_seq RESTART WITH 1');
            }
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Booking ID counter reset failed: ' . $e->getMessage());
        }

        // 3) Clear the bookings log file so old errors don't confuse things.
        try {
            $logPath = storage_path('logs/bookings.log');
            if (is_file($logPath)) {
                file_put_contents($logPath, '');
            }
        } catch (\Throwable $e) {
            // Non-fatal: a locked log file shouldn't block the reset.
        }

        \Log::channel('bookings')->warning('Booking system restarted (full reset to #1) by admin', [
            'admin_id'         => auth()->id(),
            'bookings_cleared' => $count,
        ]);

        $message = "Booking system restarted. {$count} booking(s) cleared and the ID counter is back to #1.";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $message, 'cleared' => $count]);
        }

        return redirect()->route('admin.bookings')->with('success', $message);
    }

    /**
     * Fire a sample booking notification to the configured inboxes so the admin
     * can confirm, in one click, that email delivery actually works on the
     * live server (SMTP password set, mailbox reachable, not spam-filtered).
     */
    public function sendTestBookingEmail(Request $request)
    {
        $recipients = config('mail.booking_recipients');

        $details = [
            'name'     => 'Test Booking (admin check)',
            'email'    => is_array($recipients) ? ($recipients[0] ?? config('mail.admin_address')) : $recipients,
            'phone'    => 'N/A',
            'adults'   => 2,
            'children' => 0,
            'package'  => 'Delivery test — please ignore',
            'message'  => 'This is a test notification sent from the admin panel to confirm booking emails are being delivered.',
        ];

        try {
            \Illuminate\Support\Facades\Mail::to($recipients)->send(new \App\Mail\BookingInquiry($details));

            $list = implode(', ', (array) $recipients);
            $message = "Test notification sent to: {$list}. Check those inboxes (and spam folders).";

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return back()->with('success', $message);
        } catch (\Throwable $e) {
            \Log::channel('bookings')->error('Test booking email failed: ' . $e->getMessage());

            $message = 'Could not send the test email: ' . $e->getMessage();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 500);
            }

            return back()->with('error', $message);
        }
    }

    public function sendBookingEmail(Booking $booking, Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            \Illuminate\Support\Facades\Mail::raw($request->message, function ($message) use ($booking, $request) {
                $message->to($booking->email, $booking->name)
                        ->subject($request->subject)
                        ->from('app@godeepafricasafari.com', 'Go Deep Africa Safari');
            });

            \App\Models\BookingActivityLog::create([
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'action' => 'email_sent',
                'description' => "Subject: \"{$request->subject}\"",
            ]);
            \Log::channel('bookings')->info('Admin sent manual email', ['booking_id' => $booking->id, 'to' => $booking->email]);

            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email sent successfully to ' . $booking->email
                ]);
            }

            return back()->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            \App\Models\BookingActivityLog::create([
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'action' => 'email_failed',
                'description' => "Subject: \"{$request->subject}\" — {$e->getMessage()}",
            ]);
            \Log::channel('bookings')->error('Admin manual email failed: '.$e->getMessage(), ['booking_id' => $booking->id, 'to' => $booking->email]);

            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function generateInvoice(Booking $booking)
    {
        return view('admin.bookings.invoice', compact('booking'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|string|in:new,pending,contacted,quoted,confirmed,cancelled,spam']);

        $previousStatus = $booking->status;
        $booking->update(['status' => $request->status]);

        \App\Models\BookingActivityLog::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'action' => 'status_changed',
            'description' => "Status changed from \"{$previousStatus}\" to \"{$request->status}\"",
        ]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'link' => 'nullable|url',
            'button_text' => 'nullable|string|max:50',
            'status' => 'required|in:active,expired',
        ]);

        \App\Models\Announcement::create($request->all());
        return back()->with('success', 'Announcement added successfully.');
    }

    public function deleteAnnouncement(\App\Models\Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }

    public function updateAnnouncementStatus(Request $request, \App\Models\Announcement $announcement)
    {
        $request->validate(['status' => 'required|in:active,expired']);
        $announcement->update(['status' => $request->status]);
        return back()->with('success', 'Announcement status updated.');
    }

    public function updateRole(Request $request, User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Only a Super Admin can change user roles.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role' => 'required|in:user,admin,sub_admin'
        ]);

        $user->update(['role' => $request->role]);
        return back()->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        // Protect the first user (Super Admin) from being deleted
        if ($user->id === 1) {
            return back()->with('error', 'The Super Admin account (User #1) is protected and cannot be deleted.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function settings()
    {
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key')->toArray();
        
        // Ensure defaults if empty
        $defaults = [
            'site_name' => config('app.name'),
            'contact_email' => 'info@godeepafricasafari.com',
            'contact_phone' => '+255 794 636 471',
            'openai_api_key' => '',
            'anthropic_api_key' => '',
            'gemini_api_key' => '',
        ];

        $settings = array_merge($defaults, $settings);

        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function clearCache()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            
            return back()->with('success', 'Website cache has been cleared successfully for all users.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error clearing cache: ' . $e->getMessage());
        }
    }
}
