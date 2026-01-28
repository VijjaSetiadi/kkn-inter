@extends('layouts.app')

@section('title', $news->title)

@section('content')
<!-- Hero Banner -->
<div class="relative h-[400px] overflow-hidden m-0">
    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover object-center">
    @else
        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200&q=80" alt="News Default" class="w-full h-full object-cover object-center">
    @endif
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-[#2d3b7f]/85 to-[#1f2a5a]/85 z-[1]"></div>
    <div class="absolute bottom-[50px] left-20 right-20 z-[2] bg-[#F9B234] px-10 py-8 rounded-none max-md:left-5 max-md:right-5 max-md:bottom-8 max-md:px-6 max-md:py-5">
        <h1 class="text-[38px] font-black text-black mb-0 leading-[1.2] tracking-tight max-md:text-[26px]">{{ $news->title }}</h1>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-white py-5 border-b border-gray-300">
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="flex flex-wrap items-center gap-2 bg-transparent m-0 p-0 text-sm">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="text-[#2d3b7f] no-underline font-medium hover:text-[#F9B234] transition-colors">Beranda</a>
                </li>
                <li class="flex items-center before:content-['›'] before:text-gray-500 before:mx-2">
                    <a href="{{ route('news.index') }}" class="text-[#2d3b7f] no-underline font-medium hover:text-[#F9B234] transition-colors">Berita</a>
                </li>
                <li class="flex items-center before:content-['›'] before:text-gray-500 before:mx-2 text-gray-600">
                    {{ Str::limit($news->title, 50) }}
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Article Meta -->
<div class="bg-gray-50 py-6 border-b border-gray-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div class="flex gap-8 items-center flex-wrap max-md:gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                    <i class="fas fa-calendar-alt text-[#2d3b7f] text-[13px]"></i>
                    <span>{{ $news->published_date->format('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                    <i class="fas fa-user text-[#2d3b7f] text-[13px]"></i>
                    <span>{{ $news->author->name ?? 'Admin KKN' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                    <i class="fas fa-eye text-[#2d3b7f] text-[13px]"></i>
                    <span>{{ $news->views }} kali dibaca</span>
                </div>
            </div>
            <div class="mt-0 max-md:w-full">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-[#2d3b7f] border border-[#2d3b7f] rounded-md no-underline font-semibold text-sm transition-all hover:bg-[#2d3b7f] hover:text-white hover:-translate-x-1 max-md:w-full max-md:justify-center">
                    <i class="fas fa-arrow-left"></i> Kembali ke Berita
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-white max-md:py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Featured Image -->
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full max-h-[500px] object-cover rounded-lg mb-10 shadow-[0_4px_12px_rgba(0,0,0,0.1)] max-md:mb-8">
            @endif
            
            <!-- Article Content -->
            <div class="prose prose-lg max-w-none">
                <style>
                    .article-content p {
                        margin-bottom: 1.25rem;
                        text-align: justify;
                        font-size: 1rem;
                        line-height: 1.8;
                        color: #333;
                    }
                    .article-content h2 {
                        font-size: 1.625rem;
                        font-weight: 700;
                        color: #2d3b7f;
                        margin-top: 2.5rem;
                        margin-bottom: 1.25rem;
                        border-bottom: 3px solid #F9B234;
                        padding-bottom: 0.625rem;
                        display: inline-block;
                    }
                    .article-content h3 {
                        font-size: 1.375rem;
                        font-weight: 700;
                        color: #2d3b7f;
                        margin-top: 1.875rem;
                        margin-bottom: 0.938rem;
                    }
                    .article-content h4 {
                        font-size: 1.125rem;
                        font-weight: 600;
                        color: #333;
                        margin-top: 1.563rem;
                        margin-bottom: 0.75rem;
                    }
                    .article-content ul,
                    .article-content ol {
                        margin-bottom: 1.25rem;
                        padding-left: 1.875rem;
                    }
                    .article-content ul li,
                    .article-content ol li {
                        margin-bottom: 0.625rem;
                        line-height: 1.7;
                    }
                </style>
                <div class="article-content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
            
            <!-- Share Section -->
            <div class="bg-gray-50 p-8 rounded-lg my-12 border border-gray-300 max-md:p-6 max-md:my-8">
                <h5 class="text-lg font-bold text-[#2d3b7f] mb-5 flex items-center gap-2.5">
                    <i class="fas fa-share-alt text-[#F9B234] text-xl"></i> Bagikan Artikel Ini
                </h5>
                <div class="flex gap-3 flex-wrap">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-md no-underline font-semibold text-sm transition-all text-white bg-[#1877f2] hover:-translate-y-1 hover:shadow-[0_6px_16px_rgba(0,0,0,0.2)] max-md:flex-1 max-md:justify-center">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-md no-underline font-semibold text-sm transition-all text-white bg-[#1da1f2] hover:-translate-y-1 hover:shadow-[0_6px_16px_rgba(0,0,0,0.2)] max-md:flex-1 max-md:justify-center">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . url()->current()) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-md no-underline font-semibold text-sm transition-all text-white bg-[#25d366] hover:-translate-y-1 hover:shadow-[0_6px_16px_rgba(0,0,0,0.2)] max-md:flex-1 max-md:justify-center">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-md no-underline font-semibold text-sm transition-all text-white bg-[#0A66C2] hover:-translate-y-1 hover:shadow-[0_6px_16px_rgba(0,0,0,0.2)] max-md:flex-1 max-md:justify-center">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                </div>
            </div>

            <!-- Article Navigation (Previous/Next) -->
            @if(isset($previousNews) || isset($nextNews))
            <div class="bg-gray-50 p-8 rounded-lg my-10 border border-gray-300 max-md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(isset($previousNews))
                    <div>
                        <a href="{{ route('news.show', $previousNews->slug) }}" class="flex items-center gap-3 px-5 py-4 bg-white border border-gray-300 rounded-md no-underline text-gray-800 transition-all hover:bg-[#2d3b7f] hover:text-white hover:border-[#2d3b7f] hover:-translate-x-1">
                            <i class="fas fa-chevron-left flex-shrink-0"></i>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-gray-500 font-medium uppercase mb-1">Berita Sebelumnya</div>
                                <div class="text-sm font-semibold m-0 truncate">{{ Str::limit($previousNews->title, 40) }}</div>
                            </div>
                        </a>
                    </div>
                    @endif
                    
                    @if(isset($nextNews))
                    <div>
                        <a href="{{ route('news.show', $nextNews->slug) }}" class="flex items-center justify-end text-right gap-3 px-5 py-4 bg-white border border-gray-300 rounded-md no-underline text-gray-800 transition-all hover:bg-[#2d3b7f] hover:text-white hover:border-[#2d3b7f] hover:translate-x-1">
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-gray-500 font-medium uppercase mb-1">Berita Selanjutnya</div>
                                <div class="text-sm font-semibold m-0 truncate">{{ Str::limit($nextNews->title, 40) }}</div>
                            </div>
                            <i class="fas fa-chevron-right flex-shrink-0"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Related News -->
@if($relatedNews->count() > 0)
<div class="bg-gray-50 py-16 border-t border-gray-300 max-md:py-10">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h2 class="text-[32px] font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-[26px]">Berita Terkait</h2>
            <p class="text-[15px] text-gray-600 mb-10">Artikel lain yang mungkin Anda minati</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedNews as $related)
            <a href="{{ route('news.show', $related->slug) }}" class="bg-white border border-gray-300 rounded-lg overflow-hidden transition-all shadow-[0_1px_3px_rgba(0,0,0,0.08)] no-underline block h-full hover:-translate-y-1.5 hover:shadow-[0_8px_20px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f]">
                @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-[180px] object-cover transition-transform duration-300 hover:scale-105" alt="{{ $related->title }}">
                @else
                    <div class="w-full h-[180px] flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-100">
                        <i class="fas fa-newspaper text-5xl text-gray-500"></i>
                    </div>
                @endif
                <div class="p-5">
                    <h5 class="text-base font-bold text-[#2d3b7f] mb-2.5 line-clamp-2 leading-snug min-h-[44px]">{{ $related->title }}</h5>
                    <p class="text-xs text-gray-500 flex items-center gap-1 font-medium m-0">
                        <i class="fas fa-calendar-alt text-[11px]"></i> {{ $related->published_date->format('d M Y') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Back to Top Button -->
<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
        class="fixed bottom-8 right-8 bg-[#2d3b7f] text-white border-none rounded-full w-12 h-12 flex items-center justify-center shadow-[0_4px_12px_rgba(45,59,127,0.3)] cursor-pointer z-[1000] transition-all hover:bg-[#F9B234]">
    <i class="fas fa-arrow-up"></i>
</button>
@endsection