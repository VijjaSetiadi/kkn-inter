{{-- resources/views/admin/pendaftaran/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                <i class="fas fa-clipboard-list text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                Data Pendaftaran KKN International
            </h2>
            <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                Kelola dan monitor seluruh pendaftaran mahasiswa KKN International
            </p>
        </div>
    </div>

    {{-- Quick Stats Summary --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
            <p class="text-xs text-gray-600 mb-1">Total Pendaftar</p>
            <p class="text-2xl font-bold text-blue-900">{{ $totalPendaftar }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
            <p class="text-xs text-gray-600 mb-1">Pending</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $pending }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-cyan-500">
            <p class="text-xs text-gray-600 mb-1">Diproses</p>
            <p class="text-2xl font-bold text-cyan-600">{{ $diproses }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-600 mb-1">Diterima</p>
            <p class="text-2xl font-bold text-green-600">{{ $diterima }}</p>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-5 border-t-4 border-blue-900">
        <h6 class="text-base font-bold text-blue-900 mb-4 flex items-center gap-2">
            <i class="fas fa-filter text-yellow-500 text-lg"></i>
            Filter & Pencarian Data
        </h6>

        <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Status Filter --}}
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- Periode Filter --}}
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-2">Periode</label>
                    <select name="periode" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                        <option value="">Semua Periode</option>
                        @foreach($periods as $period)
                            <option value="{{ $period->name }}" {{ request('periode') == $period->name ? 'selected' : '' }}>
                                {{ $period->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Negara Filter --}}
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-2">Negara Tujuan</label>
                    <select name="negara" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                        <option value="">Semua Negara</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->country }}" {{ request('negara') == $destination->country ? 'selected' : '' }}>
                                {{ $destination->country }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Search --}}
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-2">Cari (NIM/Nama)</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari..." 
                           class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-search"></i>
                    Cari
                </button>
                <a href="{{ route('admin.pendaftaran.index') }}" class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-redo"></i>
                    Reset Filter
                </a>
                <a href="{{ route('admin.export') }}?{{ http_build_query(request()->all()) }}" class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    Export Excel
                </a>
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                <i class="fas fa-table text-yellow-400 text-xl"></i>
                Tabel Data Pendaftaran
            </h3>
        </div>

        @if($pendaftaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">No</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Tanggal</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">NIM</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Nama</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Prodi</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Periode</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Negara</th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-blue-900 uppercase">Status</th>
                            <th class="px-3 py-3 text-center text-xs font-bold text-blue-900 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pendaftaran as $index => $item)
                        @if($item->mahasiswa)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-yellow-50/30 transition-all duration-200">
                            <td class="px-3 py-3 text-xs font-semibold text-gray-700">{{ $pendaftaran->firstItem() + $index }}</td>
                            <td class="px-3 py-3 text-xs text-gray-600 whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-3 py-3 text-xs font-bold text-blue-900">{{ $item->mahasiswa->nim ?? 'N/A' }}</td>
                            <td class="px-3 py-3 text-xs font-medium text-gray-700">{{ Str::limit($item->mahasiswa->nama ?? 'N/A', 20) }}</td>
                            <td class="px-3 py-3 text-xs text-gray-600">{{ Str::limit($item->mahasiswa->program_studi ?? '-', 15) }}</td>
                            <td class="px-3 py-3 text-xs text-gray-600 whitespace-nowrap">{{ $item->periode }}</td>
                            <td class="px-3 py-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                    {{ $item->negara_tujuan }}
                                </span>
                            </td>
                            <td class="px-3 py-3">
                                @if($item->status == 'pending')
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                        ⏳ Pending
                                    </span>
                                @elseif($item->status == 'diproses')
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                        🔄 Diproses
                                    </span>
                                @elseif($item->status == 'diterima')
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                        ✅ Diterima
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                        ❌ Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.pendaftaran.show', $item->id) }}" 
                                       class="w-7 h-7 flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                                       title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn-edit-status w-7 h-7 flex items-center justify-center bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                                            data-id="{{ $item->id }}"
                                            data-nama="{{ $item->mahasiswa->nama ?? 'N/A' }}"
                                            data-nim="{{ $item->mahasiswa->nim ?? 'N/A' }}"
                                            data-status="{{ $item->status }}"
                                            data-catatan="{{ $item->catatan_admin }}"
                                            title="Edit Status">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>
                                    <button type="button" 
                                            class="w-7 h-7 flex items-center justify-center bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                                            onclick="confirmDelete({{ $item->id }})"
                                            title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                    
                                    <form id="delete-form-{{ $item->id }}" 
                                          action="{{ route('admin.pendaftaran.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t-2 border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm font-medium text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        Menampilkan <span class="font-bold text-blue-900">{{ $pendaftaran->firstItem() }}</span> - <span class="font-bold text-blue-900">{{ $pendaftaran->lastItem() }}</span> dari <span class="font-bold text-blue-900">{{ $pendaftaran->total() }}</span> data
                    </div>
                    <div>
                        {{ $pendaftaran->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <i class="fas fa-inbox text-6xl text-gray-200 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-3">Belum ada data pendaftaran</h3>
                <p class="text-gray-500 text-lg">Data pendaftaran KKN International akan muncul di sini setelah mahasiswa mendaftar</p>
            </div>
        @endif
    </div>
</div>

{{-- Modal Edit Status --}}
<div id="editStatusModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto transform transition-all">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400 rounded-t-xl">
            <div class="flex items-center justify-between">
                <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-edit text-yellow-400 text-xl drop-shadow"></i>
                    Edit Status Pendaftaran
                </h5>
                <button type="button" class="modal-close text-white hover:text-yellow-400 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Modal Body --}}
        <form id="formEditStatus" method="POST" class="p-6 bg-gray-50">
            @csrf
            
            {{-- Info Box --}}
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6">
                <div class="flex items-center gap-3">
                    <i class="fas fa-user-circle text-blue-600 text-2xl"></i>
                    <div>
                        <p class="font-bold text-blue-900" id="modalMahasiswaInfo"></p>
                    </div>
                </div>
            </div>

            {{-- Current Status --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-blue-900 mb-2">Status Saat Ini</label>
                <div id="modalCurrentStatus"></div>
            </div>

            {{-- New Status --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-blue-900 mb-2">
                    Ubah Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="modalStatusSelect" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                    <option value="pending">⏳ Pending - Menunggu Verifikasi</option>
                    <option value="diproses">🔄 Diproses - Sedang Diseleksi</option>
                    <option value="diterima">✅ Diterima - Lolos Seleksi</option>
                    <option value="ditolak">❌ Ditolak - Tidak Lolos</option>
                </select>
                <p class="text-xs text-gray-500 mt-2 flex items-start gap-2">
                    <i class="fas fa-info-circle mt-0.5"></i>
                    <span>Pilih status baru untuk pendaftaran ini</span>
                </p>
            </div>

            {{-- Admin Notes --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-blue-900 mb-2">
                    Catatan Admin <span class="text-gray-400">(Opsional)</span>
                </label>
                <textarea name="catatan_admin" id="modalCatatanAdmin" rows="4" placeholder="Berikan catatan atau alasan perubahan status untuk mahasiswa..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium resize-none"></textarea>
                <p class="text-xs text-gray-500 mt-2 flex items-start gap-2">
                    <i class="fas fa-lightbulb mt-0.5"></i>
                    <span>Catatan ini akan membantu mahasiswa memahami keputusan</span>
                </p>
            </div>

            {{-- Modal Footer --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t-2 border-gray-200">
                <button type="button" class="modal-close flex-1 px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit" class="flex-1 px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Elements
    const modal = document.getElementById('editStatusModal');
    const modalCloses = document.querySelectorAll('.modal-close');
    const editButtons = document.querySelectorAll('.btn-edit-status');
    const form = document.getElementById('formEditStatus');
    
    // Open Modal
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const nim = this.dataset.nim;
            const status = this.dataset.status;
            const catatan = this.dataset.catatan;
            
            // Set form action
            form.action = `/admin/pendaftaran/${id}/update-status`;
            
            // Set mahasiswa info
            document.getElementById('modalMahasiswaInfo').textContent = `${nama} (${nim})`;
            
            // Set current status
            document.getElementById('modalStatusSelect').value = status;
            
            // Set catatan admin
            document.getElementById('modalCatatanAdmin').value = catatan || '';
            
            // Set current status badge
            let statusBadge = '';
            switch(status) {
                case 'pending':
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-semibold shadow-sm">⏳ Pending</span>';
                    break;
                case 'diproses':
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold shadow-sm">🔄 Diproses</span>';
                    break;
                case 'diterima':
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-semibold shadow-sm">✅ Diterima</span>';
                    break;
                case 'ditolak':
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold shadow-sm">❌ Ditolak</span>';
                    break;
            }
            document.getElementById('modalCurrentStatus').innerHTML = statusBadge;
            
            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close Modal
    modalCloses.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
    });
    
    // Close on background click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Form Submit Handler
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 3000);
    });
});

// Confirm Delete Function
function confirmDelete(id) {
    if (confirm('⚠️ PERHATIAN!\n\nApakah Anda yakin ingin menghapus data pendaftaran ini?\n\nTindakan ini tidak dapat dibatalkan!')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

// Smooth scroll to top on pagination
document.querySelectorAll('.pagination a').forEach(link => {
    link.addEventListener('click', function() {
        setTimeout(() => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }, 100);
    });
});

// Export button loading
const exportBtn = document.querySelector('a[href*="export"]');
if (exportBtn) {
    exportBtn.addEventListener('click', function() {
        const originalHTML = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengekspor...';
        this.classList.add('opacity-75', 'pointer-events-none');
        
        setTimeout(() => {
            this.innerHTML = originalHTML;
            this.classList.remove('opacity-75', 'pointer-events-none');
        }, 2000);
    });
}

// Search input enhancement
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.classList.add('border-blue-500', 'bg-white');
            this.classList.remove('border-gray-200', 'bg-gray-50');
        } else {
            this.classList.remove('border-blue-500', 'bg-white');
            this.classList.add('border-gray-200', 'bg-gray-50');
        }
    });
}

console.log('✅ Data Pendaftaran - Separated from Dashboard');
</script>
@endpush