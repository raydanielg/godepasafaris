<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::latest()->take(3)->get();
        $posts = Post::latest()->take(3)->get();
        $destinations = \App\Models\Destination::latest()->take(3)->get();
        
        // Fetch all tour titles for the inquiry modal
        $safariTours = SafariPackage::select('id', 'title')->get();
        $kiliTours = KilimanjaroPackage::select('id', 'title')->get();
        $allTourOptions = $safariTours->concat($kiliTours);

        $testimonials = [
            ['name' => 'Emma Thompson', 'location' => 'United Kingdom', 'content' => 'The Machame Route was challenging but rewarding. Go Deep Africa made it seamless!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=emma'],
            ['name' => 'James Wilson', 'location' => 'Australia', 'content' => 'Incredible 7-day safari! Saw the Great Migration in the Serengeti. A dream come true.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=james'],
            ['name' => 'Sofia Rodriguez', 'location' => 'Spain', 'content' => 'Professional guides and amazing food. Lemosho route success! Thank you so much.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=sofia'],
            ['name' => 'Lars Jensen', 'location' => 'Denmark', 'content' => 'Very well organized. The attention to detail was impressive throughout the trek.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=lars'],
            ['name' => 'Yuki Tanaka', 'location' => 'Japan', 'content' => 'Amazing experience. The wildlife encounters were beyond my expectations.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=yuki'],
            ['name' => 'David Miller', 'location' => 'USA', 'content' => 'Top-notch equipment and safety standards. Felt very secure on the mountain.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=david'],
            ['name' => 'Amira Hassan', 'location' => 'Egypt', 'content' => 'The cultural tour in Arusha was a highlight. Very authentic and educational.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=amira'],
            ['name' => 'Hans Schmidt', 'location' => 'Germany', 'content' => 'Excellent logistics. Everything from airport pickup to drop-off was perfect.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=hans'],
            ['name' => 'Isabella Conti', 'location' => 'Italy', 'content' => 'Zanzibar was the perfect way to end our safari. Beautiful beaches and resorts.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=isabella'],
            ['name' => 'Robert Brown', 'location' => 'Canada', 'content' => 'The guides knowledge of animal behavior is truly remarkable. Learned so much.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=robert'],
            ['name' => 'Chloe Dubois', 'location' => 'France', 'content' => 'Magnificent landscapes and friendly people. Tanzania has stolen my heart.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=chloe'],
            ['name' => 'Markus Weber', 'location' => 'Switzerland', 'content' => 'Safety first approach on Kilimanjaro was much appreciated. Highly recommended.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=markus'],
            ['name' => 'Elena Petrova', 'location' => 'Russia', 'content' => 'Great value for money. The luxury safari experience exceeded all expectations.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=elena'],
            ['name' => 'William Tan', 'location' => 'Singapore', 'content' => 'Efficient booking process and very responsive customer service. 5 stars!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=william'],
            ['name' => 'Maria Garcia', 'location' => 'Mexico', 'content' => 'The Ngorongoro Crater is like nowhere else on earth. A must-see destination.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=maria'],
            ['name' => 'John Smith', 'location' => 'USA', 'content' => 'Perfect honeymoon! The private safari was romantic and adventurous at once.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=johns'],
            ['name' => 'Heidi Mueller', 'location' => 'Austria', 'content' => 'Tanzania is a beautiful country. Go Deep Africa showed us its best parts.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=heidi'],
            ['name' => 'Paolo Rossi', 'location' => 'Italy', 'content' => 'Great food even on the mountain! The chef did an amazing job every day.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=paolo'],
            ['name' => 'Sarah Johnson', 'location' => 'USA', 'content' => 'Tarangire elephants are majestic. Such a special experience for our family.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=sarahj'],
            ['name' => 'Finn Nielsen', 'location' => 'Norway', 'content' => 'The Northern Circuit is the way to go. Quiet trails and high success rates.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=finn'],
            ['name' => 'Lucas Silva', 'location' => 'Brazil', 'content' => 'Energy and enthusiasm of the guides made the trip truly unforgettable!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=lucas'],
        ];

        return view('welcome', compact('packages', 'posts', 'allTourOptions', 'testimonials'));
    }

    public function testimonials()
    {
        $testimonials = [
            ['name' => 'Emma Thompson', 'location' => 'United Kingdom', 'content' => 'The Machame Route was challenging but rewarding. Go Deep Africa made it seamless!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=emma'],
            ['name' => 'James Wilson', 'location' => 'Australia', 'content' => 'Incredible 7-day safari! Saw the Great Migration in the Serengeti. A dream come true.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=james'],
            ['name' => 'Sofia Rodriguez', 'location' => 'Spain', 'content' => 'Professional guides and amazing food. Lemosho route success! Thank you so much.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=sofia'],
            ['name' => 'Lars Jensen', 'location' => 'Denmark', 'content' => 'Very well organized. The attention to detail was impressive throughout the trek.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=lars'],
            ['name' => 'Yuki Tanaka', 'location' => 'Japan', 'content' => 'Amazing experience. The wildlife encounters were beyond my expectations.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=yuki'],
            ['name' => 'David Miller', 'location' => 'USA', 'content' => 'Top-notch equipment and safety standards. Felt very secure on the mountain.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=david'],
            ['name' => 'Amira Hassan', 'location' => 'Egypt', 'content' => 'The cultural tour in Arusha was a highlight. Very authentic and educational.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=amira'],
            ['name' => 'Hans Schmidt', 'location' => 'Germany', 'content' => 'Excellent logistics. Everything from airport pickup to drop-off was perfect.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=hans'],
            ['name' => 'Isabella Conti', 'location' => 'Italy', 'content' => 'Zanzibar was the perfect way to end our safari. Beautiful beaches and resorts.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=isabella'],
            ['name' => 'Robert Brown', 'location' => 'Canada', 'content' => 'The guides knowledge of animal behavior is truly remarkable. Learned so much.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=robert'],
            ['name' => 'Chloe Dubois', 'location' => 'France', 'content' => 'Magnificent landscapes and friendly people. Tanzania has stolen my heart.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=chloe'],
            ['name' => 'Markus Weber', 'location' => 'Switzerland', 'content' => 'Safety first approach on Kilimanjaro was much appreciated. Highly recommended.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=markus'],
            ['name' => 'Elena Petrova', 'location' => 'Russia', 'content' => 'Great value for money. The luxury safari experience exceeded all expectations.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=elena'],
            ['name' => 'William Tan', 'location' => 'Singapore', 'content' => 'Efficient booking process and very responsive customer service. 5 stars!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=william'],
            ['name' => 'Maria Garcia', 'location' => 'Mexico', 'content' => 'The Ngorongoro Crater is like nowhere else on earth. A must-see destination.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=maria'],
            ['name' => 'John Smith', 'location' => 'USA', 'content' => 'Perfect honeymoon! The private safari was romantic and adventurous at once.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=johns'],
            ['name' => 'Heidi Mueller', 'location' => 'Austria', 'content' => 'Tanzania is a beautiful country. Go Deep Africa showed us its best parts.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=heidi'],
            ['name' => 'Paolo Rossi', 'location' => 'Italy', 'content' => 'Great food even on the mountain! The chef did an amazing job every day.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=paolo'],
            ['name' => 'Sarah Johnson', 'location' => 'USA', 'content' => 'Tarangire elephants are majestic. Such a special experience for our family.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=sarahj'],
            ['name' => 'Finn Nielsen', 'location' => 'Norway', 'content' => 'The Northern Circuit is the way to go. Quiet trails and high success rates.', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=finn'],
            ['name' => 'Lucas Silva', 'location' => 'Brazil', 'content' => 'Energy and enthusiasm of the guides made the trip truly unforgettable!', 'rating' => 5, 'image' => 'https://i.pravatar.cc/150?u=lucas'],
        ];
        return view('pages.testimonials', compact('testimonials'));
    }
}
