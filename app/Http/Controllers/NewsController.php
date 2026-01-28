<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of published news
     */
    public function index(Request $request)
    {
        $query = News::published()->latest();

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $news = $query->paginate(9);
        $latestNews = News::published()->latest()->take(3)->get();

        return view('news.index', compact('news', 'latestNews'));
    }

    /**
     * Display the specified news article
     */
    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->published()
                    ->firstOrFail();

        // Increment views
        $news->incrementViews();

        // Get related news (same category or latest)
        $relatedNews = News::published()
                           ->where('id', '!=', $news->id)
                           ->latest()
                           ->take(3)
                           ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}