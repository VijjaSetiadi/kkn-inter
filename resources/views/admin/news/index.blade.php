{{-- resources/views/admin/news/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                    <i class="fas fa-newspaper text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                    Kelola Berita
                </h2>
                <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                    Tambah, edit, dan hapus berita KKN International
                </p>
            </div>
            <button onclick="openAddModal()" 
                    class="px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-plus"></i>
                Tambah Berita Baru
            </button>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-5 border-t-4 border-blue-900">
        <h6 class="text-base font-bold text-blue-900 mb-4 flex items-center gap-2">
            <i class="fas fa-filter text-yellow-500 text-lg"></i>
            Filter & Pencarian Berita
        </h6>
        
        <form method="GET" action="{{ route('admin.news.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            {{-- Status Filter --}}
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-blue-900 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            
            {{-- Search --}}
            <div class="md:col-span-6">
                <label class="block text-sm font-semibold text-blue-900 mb-2">Cari Berita</label>
                <input type="text" 
                       name="search" 
                       class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium" 
                       placeholder="Cari berdasarkan judul..." 
                       value="{{ request('search') }}">
            </div>
            
            {{-- Buttons --}}
            <div class="md:col-span-3 flex gap-2">
                <button type="submit" class="flex-1 px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    Cari
                </button>
                <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- News Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col border-2 border-gray-100 hover:border-blue-900 group">
            {{-- Image --}}
            <div class="relative w-full h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                         alt="{{ $item->title }}">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                    </div>
                @endif
                <span class="absolute top-3 right-3 px-3 py-1.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white text-xs font-bold uppercase tracking-wider rounded-md shadow-lg">
                    NEWS
                </span>
            </div>
            
            {{-- Content --}}
            <div class="p-5 flex-1 flex flex-col">
                {{-- Status Badge --}}
                <div class="mb-3">
                    @if($item->status == 'published')
                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-semibold shadow-sm uppercase tracking-wide">
                        Published
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-yellow-500 to-yellow-400 text-white text-xs font-semibold shadow-sm uppercase tracking-wide">
                        Draft
                    </span>
                    @endif
                </div>
                
                {{-- Title --}}
                <h5 class="text-lg font-bold text-blue-900 mb-3 line-clamp-2 min-h-[56px] group-hover:text-yellow-500 transition-colors duration-300">
                    {{ $item->title }}
                </h5>
                
                {{-- Excerpt --}}
                <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1">
                    {{ $item->excerpt }}
                </p>
                
                {{-- Meta --}}
                <div class="flex gap-4 text-xs text-gray-400 font-semibold pt-4 border-t-2 border-gray-100">
                    <span class="flex items-center gap-1.5">
                        <i class="fas fa-calendar text-yellow-500"></i>
                        {{ $item->published_date->format('d M Y') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i class="fas fa-eye text-yellow-500"></i>
                        {{ $item->views ?? 0 }}
                    </span>
                </div>
            </div>
            
            {{-- Footer Actions --}}
            <div class="bg-gradient-to-b from-gray-50 to-white border-t-2 border-gray-100 p-4">
                <div class="flex gap-2">
                    <button onclick="editNews({{ $item->id }}, '{{ $item->title }}', '{{ $item->slug }}', `{{ $item->excerpt }}`, `{{ addslashes($item->content) }}`, '{{ $item->image }}', '{{ $item->status }}', '{{ $item->published_date->format('Y-m-d') }}')" 
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>
                        Edit
                    </button>
                    
                    <button onclick="confirmDelete({{ $item->id }})" 
                            class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    
                    <a href="{{ route('news.show', $item->slug) }}" 
                       target="_blank"
                       class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye text-xs"></i>
                    </a>
                </div>
            </div>
            
            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-xl shadow-md p-16 text-center border-2 border-gray-100">
                <i class="fas fa-newspaper text-6xl text-gray-200 mb-4"></i>
                <h5 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h5>
                <p class="text-gray-400">Klik tombol "Tambah Berita Baru" untuk membuat berita pertama Anda</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
    <div class="flex justify-center mt-8">
        {{ $news->links() }}
    </div>
    @endif
</div>

{{-- Modal Tambah/Edit Berita --}}
<div id="modalBerita" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl my-8">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400 rounded-t-xl">
            <div class="flex items-center justify-between">
                <h5 id="modalTitle" class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-newspaper text-yellow-400 text-xl drop-shadow"></i>
                    Tambah Berita Baru
                </h5>
                <button type="button" onclick="closeModal()" class="text-white hover:text-yellow-400 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
        
        {{-- Modal Body --}}
        <form id="formBerita" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="p-6 bg-gray-50">
            @csrf
            <input type="hidden" id="methodField" name="_method" value="POST">
            <input type="hidden" id="newsId" name="news_id">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column --}}
                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="newsTitle" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium" 
                               required 
                               placeholder="Masukkan judul berita...">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Slug (URL) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="slug" 
                               id="newsSlug" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium" 
                               required 
                               placeholder="judul-berita-slug">
                        <small class="text-xs text-gray-500 mt-1 block">URL berita akan menjadi: /news/judul-berita-slug</small>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Ringkasan/Excerpt <span class="text-red-500">*</span>
                        </label>
                        <textarea name="excerpt" 
                                  id="newsExcerpt" 
                                  rows="3" 
                                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium resize-none" 
                                  required 
                                  placeholder="Ringkasan singkat berita (maks. 200 karakter)"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Konten Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" 
                                  id="newsContent" 
                                  rows="10" 
                                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium resize-none" 
                                  required 
                                  placeholder="Tulis konten berita lengkap di sini..."></textarea>
                    </div>
                </div>
                
                {{-- Right Column --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Gambar Berita</label>
                        <input type="file" 
                               name="image" 
                               id="newsImage" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium" 
                               accept="image/*">
                        <small class="text-xs text-gray-500 mt-1 block">Format: JPG, PNG, Max 2MB</small>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Tanggal Publikasi <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="published_date" 
                               id="newsPublishedDate" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                                id="newsStatus" 
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-sm font-medium" 
                                required>
                            <option value="draft">Draft - Belum Dipublikasi</option>
                            <option value="published">Published - Tampil di Website</option>
                        </select>
                    </div>
                </div>
            </div>
            
            {{-- Modal Footer --}}
            <div class="flex gap-3 mt-6 pt-6 border-t-2 border-gray-200">
                <button type="button" 
                        onclick="closeModal()"
                        class="flex-1 px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Modal Functions
function openAddModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-newspaper text-yellow-400 text-xl drop-shadow"></i> Tambah Berita Baru';
    document.getElementById('formBerita').reset();
    document.getElementById('newsId').value = '';
    document.getElementById('methodField').value = 'POST';
    document.getElementById('formBerita').action = '{{ route("admin.news.store") }}';
    document.getElementById('imagePreview').innerHTML = '';
    
    // Set default date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('newsPublishedDate').value = today;
    
    document.getElementById('modalBerita').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalBerita').classList.add('hidden');
}

function editNews(id, title, slug, excerpt, content, image, status, publishedDate) {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit text-yellow-400 text-xl drop-shadow"></i> Edit Berita';
    document.getElementById('newsId').value = id;
    document.getElementById('methodField').value = 'PUT';
    document.getElementById('formBerita').action = `/admin/news/${id}`;
    
    document.getElementById('newsTitle').value = title;
    document.getElementById('newsSlug').value = slug;
    document.getElementById('newsExcerpt').value = excerpt;
    document.getElementById('newsContent').value = content;
    document.getElementById('newsStatus').value = status;
    document.getElementById('newsPublishedDate').value = publishedDate;
    
    if (image) {
        document.getElementById('imagePreview').innerHTML = `<img src="/storage/${image}" class="w-full rounded-lg border-2 border-gray-200">`;
    }
    
    document.getElementById('modalBerita').classList.remove('hidden');
}

function confirmDelete(id) {
    if (confirm('⚠️ PERHATIAN!\n\nApakah Anda yakin ingin menghapus berita ini?\n\nTindakan ini tidak dapat dibatalkan!')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('newsTitle');
    const slugInput = document.getElementById('newsSlug');
    const imageInput = document.getElementById('newsImage');
    const imagePreview = document.getElementById('imagePreview');
    
    // Auto-generate slug from title
    titleInput.addEventListener('input', function() {
        if (!document.getElementById('newsId').value) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            slugInput.value = slug;
        }
    });
    
    // Image preview
    imageInput.addEventListener('change', function() {
        imagePreview.innerHTML = '';
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full rounded-lg border-2 border-gray-200">`;
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Close modal on outside click
    document.getElementById('modalBerita').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
});

console.log('✅ Admin News Page - Tailwind CSS Version Loaded Successfully');
</script>
@endpush