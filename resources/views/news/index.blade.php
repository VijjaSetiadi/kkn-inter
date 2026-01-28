@extends('layouts.app')

@section('title', 'Berita KKN International')

@section('content')
<!-- Hero Banner -->
<div class="relative h-[500px] overflow-hidden m-0">
    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200&q=80" alt="Berita KKN International" class="w-full h-full object-cover object-center">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-[#2d3b7f]/85 to-[#1f2a5a]/85 z-[1]"></div>
    
    <div class="absolute bottom-[60px] left-20 max-w-[700px] z-[2] bg-[#F9B234] px-11 py-9 rounded-none max-md:left-5 max-md:right-5 max-md:bottom-10 max-md:px-6 max-md:max-w-none">
        <h1 class="text-5xl font-black text-black mb-4 leading-tight tracking-tight max-md:text-[32px]">Berita & Informasi</h1>
    </div>
    <div class="absolute bottom-[60px] left-20 max-w-[700px] z-[2] bg-[#2d3b7f] px-11 py-6 -mt-5 max-md:left-5 max-md:right-5 max-md:bottom-10 max-md:px-6 max-md:max-w-none">
        <p class="text-[15px] text-white m-0 leading-relaxed font-normal max-md:text-sm">
            Dapatkan informasi terbaru seputar program KKN International, berita kegiatan, pengalaman mahasiswa, 
            dan update terkini dari universitas mitra di seluruh dunia.
        </p>
    </div>
</div>

<!-- Search Section -->
<div class="bg-white py-8 border-b border-gray-300">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('news.index') }}" class="max-w-[600px] mx-auto">
            <div class="flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    class="flex-1 border border-gray-400 rounded-md px-5 py-3 text-sm font-normal focus:border-[#2d3b7f] focus:outline-none focus:ring-2 focus:ring-[#2d3b7f]/15" 
                    placeholder="Cari berita berdasarkan judul atau konten..." 
                    value="{{ request('search') }}"
                >
                <button class="bg-[#2d3b7f] text-white border-none px-7 py-3 rounded-md font-semibold text-sm hover:bg-[#1f2a5a] transition-colors" type="submit">
                    <i class="fas fa-search mr-1"></i> Cari Berita
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Statistics -->
<div class="bg-white py-12 border-b border-gray-300">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-1/2 md:w-1/4 px-4 mb-8 md:mb-0">
                <div class="text-center p-5">
                    <div class="text-[42px] font-extrabold text-[#2d3b7f] leading-none mb-2">{{ $news->total() }}</div>
                    <div class="text-sm font-semibold text-gray-600">Total Berita</div>
                </div>
            </div>
            <div class="w-1/2 md:w-1/4 px-4 mb-8 md:mb-0">
                <div class="text-center p-5">
                    <div class="text-[42px] font-extrabold text-[#2d3b7f] leading-none mb-2">{{ \App\Models\News::where('created_at', '>=', now()->subDays(30))->count() }}</div>
                    <div class="text-sm font-semibold text-gray-600">Berita Bulan Ini</div>
                </div>
            </div>
            <div class="w-1/2 md:w-1/4 px-4">
                <div class="text-center p-5">
                    <div class="text-[42px] font-extrabold text-[#2d3b7f] leading-none mb-2">{{ \App\Models\News::sum('views') }}</div>
                    <div class="text-sm font-semibold text-gray-600">Total Pembaca</div>
                </div>
            </div>
            <div class="w-1/2 md:w-1/4 px-4">
                <div class="text-center p-5">
                    <div class="text-[42px] font-extrabold text-[#2d3b7f] leading-none mb-2">{{ date('Y') }}</div>
                    <div class="text-sm font-semibold text-gray-600">Tahun Aktif</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h2 class="text-[32px] font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-[26px]">Berita Terbaru</h2>
            <p class="text-[15px] text-gray-600 mb-10">Informasi dan berita terkini seputar KKN International</p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($news as $item)
            <div class="bg-white border border-gray-300 rounded-lg overflow-hidden transition-all shadow-[0_1px_3px_rgba(0,0,0,0.08)] hover:-translate-y-1.5 hover:shadow-[0_8px_20px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] flex flex-col h-full">
                <div class="relative w-full h-[200px] overflow-hidden bg-gray-50">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" alt="{{ $item->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-100">
                            <i class="fas fa-newspaper text-5xl text-gray-500"></i>
                        </div>
                    @endif
                    <span class="absolute top-3 right-3 bg-[#2d3b7f] text-white px-3.5 py-1.5 rounded text-[11px] font-semibold uppercase tracking-wide shadow-[0_2px_8px_rgba(45,59,127,0.3)]">Berita</span>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-[17px] font-bold text-[#2d3b7f] mb-3 leading-snug line-clamp-2 min-h-[48px] tracking-tight">{{ $item->title }}</h3>
                    <p class="text-gray-600 text-[13px] leading-relaxed mb-4 line-clamp-3 flex-1">{{ $item->excerpt }}</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 mt-auto">
                        <span class="text-gray-500 text-xs flex items-center gap-1 font-medium">
                            <i class="fas fa-calendar-alt text-[11px]"></i>
                            {{ $item->published_date->format('d M Y') }}
                        </span>
                        <a href="{{ route('news.show', $item->slug) }}" class="text-[#2d3b7f] font-semibold no-underline text-[13px] transition-all flex items-center gap-1 hover:text-[#F9B234] hover:gap-2">
                            Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-20 px-5 bg-white rounded-lg border border-gray-300">
                    <i class="fas fa-newspaper text-[64px] text-gray-300 mb-5"></i>
                    <h5 class="text-lg font-bold text-gray-800 mb-2">Belum Ada Berita</h5>
                    <p class="text-sm text-gray-500 m-0">Saat ini belum ada berita yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="flex justify-center mt-10">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="container mx-auto px-4 mb-12">
    <div class="bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-xl py-12 px-8 text-center text-white">
        <h3 class="text-[32px] font-extrabold mb-4 tracking-tight">
            Ingin Mendapatkan Informasi Terbaru?
        </h3>
        <p class="text-base mb-8 opacity-95">
            Ikuti media sosial kami dan jangan lewatkan update berita seputar KKN International
        </p>
        <div class="flex gap-3 justify-center flex-wrap">
            <a href="#" class="bg-white text-[#2d3b7f] px-7 py-3 font-semibold rounded-md text-sm hover:bg-gray-100 transition-colors inline-block">
                <i class="fab fa-instagram mr-2"></i> Instagram
            </a>
            <a href="#" class="bg-white text-[#2d3b7f] px-7 py-3 font-semibold rounded-md text-sm hover:bg-gray-100 transition-colors inline-block">
                <i class="fab fa-facebook mr-2"></i> Facebook
            </a>
            <a href="#" class="bg-white text-[#2d3b7f] px-7 py-3 font-semibold rounded-md text-sm hover:bg-gray-100 transition-colors inline-block">
                <i class="fab fa-youtube mr-2"></i> YouTube
            </a>
        </div>
    </div>
</div>
@endsection