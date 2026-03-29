<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafariPackage;
use App\Models\KilimanjaroPackage;
use App\Models\Post;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $safaris = SafariPackage::all();
        $kilis = KilimanjaroPackage::all();
        $posts = Post::all();
        $routes = ['machame', 'lemosho', 'marangu', 'rongai', 'umbwe', 'northern'];

        return Response::view('sitemap', [
            'safaris' => $safaris,
            'kilis' => $kilis,
            'posts' => $posts,
            'routes' => $routes
        ])->header('Content-Type', 'text/xml');
    }
}
