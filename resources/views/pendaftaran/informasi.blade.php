@extends('layouts.app')

@section('title', 'Informasi KKN International')

@section('content')
<!-- Hero Banner -->
<div class="relative h-[600px] overflow-hidden m-0">
    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=80" alt="KKN International" class="w-full h-full object-cover object-center">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-[#2d3b7f]/85 to-[#1f2a5a]/85 z-[1]"></div>
    
    <div class="absolute bottom-20 left-20 max-w-[700px] z-[2] bg-[#F9B234] px-12 py-10 rounded-none max-md:left-5 max-md:right-5 max-md:bottom-10 max-md:px-8 max-md:max-w-none">
        <h1 class="text-[56px] font-black text-black mb-5 leading-tight tracking-tight max-md:text-4xl">KKN International</h1>
    </div>
    <div class="absolute bottom-20 left-20 max-w-[700px] z-[2] bg-[#2d3b7f] px-12 py-8 -mt-5 max-md:left-5 max-md:right-5 max-md:bottom-10 max-md:px-8 max-md:max-w-none">
        <p class="text-base text-white m-0 leading-relaxed font-normal">
            Program KKN International memberikan kesempatan kepada mahasiswa untuk melaksanakan Kuliah Kerja Nyata di negara-negara mitra. 
            Mahasiswa akan mendapatkan pengalaman unik dalam mengabdi kepada masyarakat internasional, memahami budaya global, 
            sekaligus mengembangkan kompetensi lintas budaya dalam lingkungan yang multikultural.
        </p>
    </div>
</div>

<div class="container mx-auto px-4">
    <div class="flex flex-wrap -mx-4">
        <!-- Sidebar Navigation -->
        <div class="w-full lg:w-1/4 px-4">
            <nav class="sticky top-[100px] bg-white border-r border-gray-300 py-8 max-lg:static max-lg:border-r-0 max-lg:border-b max-lg:py-5">
                <a href="#tentang" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-700 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Tentang Program</a>
                <a href="#persyaratan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-700 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Persyaratan</a>
                <a href="#negara-tujuan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-700 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Negara Tujuan</a>
                <a href="#panduan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-700 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Panduan Lengkap</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="py-16">
                <!-- Tentang Program Section -->
                <section id="tentang" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Tentang Program KKN International</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Kuliah Kerja Nyata (KKN) International merupakan program pengabdian masyarakat yang dilaksanakan di negara-negara mitra 
                        Universitas Semarang. Program ini dirancang untuk memberikan pengalaman langsung kepada mahasiswa dalam berinteraksi 
                        dengan masyarakat global dan mengembangkan kompetensi lintas budaya.
                    </p>

                    <div class="bg-gradient-to-r from-[#2d3b7f] to-[#1f2a5a] text-white rounded-xl p-8 mb-8">
                        <h4 class="text-[22px] font-bold mb-4 tracking-tight">✨ Program Unggulan</h4>
                        <p class="text-[15px] leading-relaxed opacity-95 mb-0">
                            KKN International merupakan kesempatan bagi mahasiswa USM untuk mengikuti program pengabdian masyarakat 
                            di negara mitra dengan fokus pada pendidikan, pemberdayaan masyarakat, dan pengembangan kompetensi global. 
                            Mahasiswa akan bekerja sama dengan lembaga mitra internasional dan melaksanakan kegiatan pengabdian 
                            yang disesuaikan dengan kebutuhan masyarakat setempat.
                        </p>
                    </div>

                    <div class="flex flex-wrap -mx-4 mt-12">
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 h-full transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">🎯 Tujuan Program</h4>
                                <ul class="list-none p-0 m-0 space-y-2">
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Mengembangkan kepekaan sosial dalam konteks global</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Menerapkan ilmu pengetahuan untuk membantu masyarakat internasional</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Meningkatkan pemahaman budaya dan kearifan lokal negara lain</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Membangun kemampuan beradaptasi di lingkungan multikultural</li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 h-full transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">🌟 Manfaat Program</h4>
                                <ul class="list-none p-0 m-0 space-y-2">
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Pengalaman pengabdian masyarakat internasional</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Pemahaman mendalam tentang budaya global</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Peningkatan kemampuan bahasa asing</li>
                                    <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-green-600 before:font-bold before:text-lg">Sertifikat yang meningkatkan nilai CV</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Persyaratan Section -->
                <section id="persyaratan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Persyaratan Peserta</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Mahasiswa yang ingin mengikuti program KKN International harus memenuhi persyaratan berikut:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white border-2 border-[#2d3b7f] rounded-xl p-8 hover:shadow-[0_8px_30px_rgba(45,59,127,0.15)] transition-all">
                            <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">📋 Persyaratan Akademik</h4>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Mahasiswa aktif minimal semester 6</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">IPK minimal 3.00</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Kemampuan bahasa Inggris baik</li>
                            </ul>
                        </div>

                        <div class="bg-white border-2 border-[#2d3b7f] rounded-xl p-8 hover:shadow-[0_8px_30px_rgba(45,59,127,0.15)] transition-all">
                            <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">👤 Persyaratan Umum</h4>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Sehat jasmani dan rohani</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Memiliki motivasi tinggi untuk mengabdi</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Memiliki paspor yang masih berlaku</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Negara Tujuan Section -->
                <section id="negara-tujuan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Negara Tujuan KKN International</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Program KKN International saat ini dilaksanakan di dua negara mitra dengan fokus kegiatan pengabdian masyarakat 
                        yang beragam sesuai dengan kebutuhan lokal.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <!-- Malaysia -->
                        <div class="bg-white border-2 border-gray-300 rounded-xl p-8 hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] transition-all">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-4xl text-white"></i>
                                </div>
                            </div>
                            <h4 class="text-[26px] font-bold text-[#2d3b7f] mb-4 text-center tracking-tight">🇲🇾 Malaysia</h4>
                            <div class="space-y-3 text-[15px] text-gray-700">
                                <p class="mb-0"><strong>Lokasi:</strong> Kuala Lumpur</p>
                                <p class="mb-0"><strong>Mitra:</strong> Sanggar Belajar untuk anak-anak PMI</p>
                                <p class="mb-0"><strong>Kegiatan:</strong> Pendidikan dasar, edukasi interaktif, pemberdayaan anak usia 4-15 tahun</p>
                            </div>
                        </div>

                        <!-- Thailand -->
                        <div class="bg-white border-2 border-gray-300 rounded-xl p-8 hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] transition-all">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center">
                                    <i class="fas fa-school text-4xl text-white"></i>
                                </div>
                            </div>
                            <h4 class="text-[26px] font-bold text-[#2d3b7f] mb-4 text-center tracking-tight">🇹🇭 Thailand</h4>
                            <div class="space-y-3 text-[15px] text-gray-700">
                                <p class="mb-0"><strong>Lokasi:</strong> Hat Yai, Thailand Selatan</p>
                                <p class="mb-0"><strong>Mitra:</strong> Alhidayah Waqaf Foundation</p>
                                <p class="mb-0"><strong>Kegiatan:</strong> Mengajar di sekolah TK-SMA, pengembangan pendidikan, pengabdian masyarakat</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#fff8e6] border-l-4 border-[#F9B234] p-6 rounded-r-lg mt-8">
                        <div class="flex items-start">
                            <i class="fas fa-lightbulb text-[#F9B234] text-xl mr-3 mt-1"></i>
                            <div>
                                <p class="text-[15px] text-gray-800 leading-relaxed m-0">
                                    <strong class="text-[#2d3b7f]">Informasi:</strong> Setiap kelompok KKN akan ditempatkan di lokasi yang 
                                    telah ditentukan dengan didampingi oleh dosen pembimbing lapangan dan koordinator lokal dari lembaga mitra.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Panduan Lengkap Section -->
                <section id="panduan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Panduan Lengkap KKN International</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Akses panduan lengkap yang berisi informasi detail tentang persiapan, dokumen, perlengkapan, tips, dan format proposal KKN International.
                    </p>

                    <!-- Panduan Card -->
                    <div class="bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-2xl p-10 text-white shadow-xl">
                        <div class="flex items-start justify-between flex-wrap gap-6">
                            <div class="flex items-start flex-1">
                                <div class="w-20 h-20 bg-white/20 rounded-xl flex items-center justify-center mr-6 flex-shrink-0">
                                    <i class="fas fa-book-open text-5xl text-[#F9B234]"></i>
                                </div>
                                <div>
                                    <h3 class="text-[28px] font-bold mb-3 tracking-tight">Guidebook KKN International</h3>
                                    <p class="text-base mb-4 opacity-90 leading-relaxed">
                                        Panduan komprehensif yang mencakup:
                                    </p>
                                    <ul class="space-y-2 text-[15px] opacity-90">
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-[#F9B234] mr-2 mt-1"></i>
                                            <span>Dokumen yang perlu disiapkan (paspor, tiket, surat tugas, asuransi)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-[#F9B234] mr-2 mt-1"></i>
                                            <span>Perlengkapan yang perlu dibawa</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-[#F9B234] mr-2 mt-1"></i>
                                            <span>Tips persiapan dan adaptasi budaya</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-[#F9B234] mr-2 mt-1"></i>
                                            <span>Format proposal program kerja</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-[#F9B234] mr-2 mt-1"></i>
                                            <span>Luaran yang harus dihasilkan</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <a href="https://docs.google.com/document/d/1-wDrxulCpxZuqV72n--8oqUsbMekIJ5a/edit" target="_blank" rel="noopener noreferrer" class="px-10 py-4 text-base font-bold rounded-xl bg-[#F9B234] text-black hover:bg-[#e8a324] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 whitespace-nowrap">
                                    <i class="fas fa-external-link-alt mr-2"></i> Buka Panduan
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <div class="flex flex-wrap -mx-4 mt-12">
                    <div class="w-full px-4">
                        <div class="bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-2xl p-12 text-center text-white shadow-2xl">
                            <div class="max-w-3xl mx-auto">
                                <h3 class="text-[38px] font-extrabold mb-4 tracking-tight max-md:text-3xl">
                                    🌏 Ready to Go Global?
                                </h3>
                                <p class="text-lg mb-8 opacity-95 leading-relaxed">
                                    Kesempatan bagi mahasiswa Universitas Semarang untuk mengikuti KKN International di negara mitra. 
                                    Daftarkan diri Anda sekarang dan mulai perjalanan global Anda bersama kami!
                                </p>
                                @auth
                                    @if(auth()->user()->role === 'mahasiswa')
                                        <a href="{{ route('mahasiswa.dashboard') }}" class="inline-block px-10 py-4 text-base font-bold rounded-xl bg-[#F9B234] text-black hover:bg-[#e8a324] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                                            <i class="fas fa-arrow-right mr-2"></i> Ke Dashboard Mahasiswa
                                        </a>
                                    @endif
                                @else
                                    <div class="flex flex-wrap justify-center gap-4">
                                        <a href="{{ route('register.mahasiswa') }}" class="inline-block px-10 py-4 text-base font-bold rounded-xl bg-[#F9B234] text-black hover:bg-[#e8a324] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                                        </a>
                                        <a href="{{ route('login') }}" class="inline-block px-10 py-4 text-base font-bold rounded-xl border-3 border-white text-white hover:bg-white hover:text-[#2d3b7f] transition-all shadow-lg">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <section class="py-16 bg-gray-50 -mx-4 px-4 mt-16 rounded-xl">
                    <h3 class="text-3xl font-extrabold text-center text-[#2d3b7f] mb-10 tracking-tight">Hubungi Kami</h3>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-envelope text-3xl text-[#2d3b7f]"></i>
                                </div>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2">Email</h5>
                                <p class="text-gray-600 text-[15px] m-0">international@usm.ac.id</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fab fa-whatsapp text-3xl text-green-600"></i>
                                </div>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2">WhatsApp</h5>
                                <p class="text-gray-600 text-[15px] m-0">+62 821 1021 0236</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-map-marker-alt text-3xl text-red-600"></i>
                                </div>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2">Alamat</h5>
                                <p class="text-gray-600 text-[15px] m-0">Gedung Rektorat Lt. 3</p>
                                <p class="text-gray-600 text-[15px] m-0">Kampus Universitas Semarang</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
// Smooth scroll untuk sidebar navigation dengan active state indicator
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.sidebar-nav-item');
    const sections = document.querySelectorAll('section[id]');
    
    // Click handler untuk smooth scroll
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 100;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Scroll handler untuk update active state
    function updateActiveNav() {
        let current = '';
        const scrollPos = window.pageYOffset + 150;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        
        navItems.forEach(item => {
            item.classList.remove('text-[#2d3b7f]', 'border-[#F9B234]', 'bg-gray-50');
            item.classList.add('text-gray-700');
            
            if (item.getAttribute('href') === '#' + current) {
                item.classList.remove('text-gray-700');
                item.classList.add('text-[#2d3b7f]', 'border-[#F9B234]', 'bg-gray-50');
            }
        });
    }
    
    // Initial check
    updateActiveNav();
    
    // Update on scroll
    window.addEventListener('scroll', updateActiveNav);
});
</script>

@endsection