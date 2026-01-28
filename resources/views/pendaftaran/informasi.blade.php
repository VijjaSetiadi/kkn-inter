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
                <a href="#persiapan" class="sidebar-nav-item active block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Persiapan Diri</a>
                <a href="#fasilitas" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Fasilitas & Keuntungan</a>
                <a href="#negara-tujuan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Negara Tujuan & Kegiatan</a>
                <a href="#brosur" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Brosur</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="py-16">
                <!-- Persiapan Diri Section -->
                <section id="persiapan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Persiapan Diri</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Kuliah Kerja Nyata (KKN) International merupakan program pengabdian masyarakat yang dilaksanakan di negara-negara mitra. 
                        Program ini dirancang untuk memberikan pengalaman langsung kepada mahasiswa dalam berinteraksi dengan masyarakat global, 
                        menerapkan ilmu pengetahuan dalam konteks internasional, dan mengembangkan kepekaan terhadap isu-isu sosial lintas budaya.
                    </p>

                    <div class="flex flex-wrap -mx-4 mt-12">
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Tujuan Program KKN International</h4>
                                <ul class="list-none p-0 m-0">
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Mengembangkan kepekaan sosial dalam konteks global</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Menerapkan ilmu pengetahuan untuk membantu masyarakat internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Meningkatkan pemahaman budaya dan kearifan lokal negara lain</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Membangun kemampuan beradaptasi di lingkungan multikultural</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Memperkuat jiwa pengabdian dan kepemimpinan global</li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Syarat Peserta KKN International</h4>
                                <ul class="list-none p-0 m-0">
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Mahasiswa aktif minimal semester 6</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">IPK minimal 3.00</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Kemampuan bahasa Inggris baik (TOEFL min. 450)</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Sehat jasmani dan rohani</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Memiliki motivasi tinggi untuk mengabdi di luar negeri</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Bersedia mengikuti pembekalan KKN International</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 my-12">
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">8</div>
                            <div class="text-[15px] font-semibold text-gray-600">Negara Tujuan KKN</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">25+</div>
                            <div class="text-[15px] font-semibold text-gray-600">Lokasi Pengabdian</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">300+</div>
                            <div class="text-[15px] font-semibold text-gray-600">Peserta KKN</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">45</div>
                            <div class="text-[15px] font-semibold text-gray-600">Hari Program</div>
                        </div>
                    </div>
                </section>

                <!-- Fasilitas & Keuntungan Section -->
                <section id="fasilitas" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Fasilitas & Keuntungan</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Program KKN International menyediakan berbagai fasilitas dan keuntungan untuk mendukung mahasiswa dalam melaksanakan 
                        pengabdian masyarakat di luar negeri dengan optimal dan aman.
                    </p>

                    <ul class="list-none p-0 my-8">
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Akomodasi yang nyaman dan aman di negara tujuan KKN</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Pembekalan intensif tentang budaya dan bahasa negara tujuan</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Pendampingan oleh dosen pembimbing selama program berlangsung</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Kesempatan berkolaborasi dengan mahasiswa internasional</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Sertifikat KKN International dari universitas</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Asuransi kesehatan dan perjalanan internasional</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Transportasi lokal selama program KKN</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Dukungan dana operasional kegiatan pengabdian</li>
                        <li class="text-base text-gray-800 py-3 pl-8 relative leading-relaxed before:content-[''] before:absolute before:left-0 before:top-[18px] before:w-2 before:h-2 before:bg-[#F9B234] before:rounded-full">Kesempatan untuk presentasi hasil KKN di forum internasional</li>
                    </ul>

                    <div class="flex flex-wrap -mx-4 mt-12">
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Manfaat Akademik & Personal</h4>
                                <ul class="list-none p-0 m-0">
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pengalaman pengabdian masyarakat internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pemahaman mendalam tentang budaya global</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Peningkatan kemampuan bahasa asing secara praktis</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pengembangan soft skills dan leadership</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Sertifikat yang meningkatkan nilai CV</li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Manfaat Profesional</h4>
                                <ul class="list-none p-0 m-0">
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Networking dengan organisasi internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pengalaman kerja di lingkungan multikultural</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Peningkatan daya saing di dunia kerja</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Portofolio proyek pengabdian internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Rekomendasi dari lembaga mitra internasional</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Negara Tujuan & Kegiatan Section -->
                <section id="negara-tujuan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Negara Tujuan & Kegiatan</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        KKN International dilaksanakan di berbagai negara mitra dengan fokus kegiatan pengabdian masyarakat yang beragam sesuai dengan kebutuhan lokal.
                    </p>

                    <div class="flex flex-wrap -mx-4 mt-8">
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 text-center transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <i class="fas fa-flag text-5xl mb-4 text-[#2d3b7f]"></i>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Malaysia & Thailand</h4>
                                <p class="mb-0 text-sm text-gray-600">Pengabdian di desa-desa terpencil, pendidikan anak, dan pemberdayaan masyarakat</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 text-center transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <i class="fas fa-hands-helping text-5xl mb-4 text-[#2d3b7f]"></i>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Filipina & Vietnam</h4>
                                <p class="mb-0 text-sm text-gray-600">Program kesehatan, sanitasi, dan peningkatan ekonomi masyarakat</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 text-center transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <i class="fas fa-globe-asia text-5xl mb-4 text-[#2d3b7f]"></i>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">Kamboja & Myanmar</h4>
                                <p class="mb-0 text-sm text-gray-600">Pengembangan teknologi tepat guna dan pendidikan vokasional</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#e8f0fe] border-none border-l-4 border-[#2d3b7f] p-5 rounded shadow-sm mt-8">
                        <i class="fas fa-info-circle mr-2 text-[#2d3b7f]"></i>
                        <strong class="text-[#2d3b7f]">Informasi:</strong> Setiap kelompok KKN akan ditempatkan di lokasi yang telah ditentukan dengan didampingi oleh dosen pembimbing lapangan dan koordinator lokal.
                    </div>
                </section>

                <!-- Brosur Section -->
                <section id="brosur" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Brosur</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Download brosur lengkap program KKN International untuk informasi lebih detail.
                    </p>

                    <div class="flex flex-wrap -mx-4 mt-8">
                        <div class="w-full px-4">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <div class="flex items-center justify-between flex-wrap gap-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-6xl mr-6 text-red-600"></i>
                                        <div>
                                            <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-2 tracking-tight">Panduan KKN International 2025</h4>
                                            <p class="mb-0 text-sm text-gray-600">
                                                Informasi lengkap tentang program, lokasi, kegiatan, persyaratan, dan alur pendaftaran KKN International
                                            </p>
                                        </div>
                                    </div>
                                    <a href="#" class="px-7 py-3 text-sm font-semibold rounded-md bg-[#2d3b7f] border-none text-white hover:bg-[#1f2a5a] transition-colors">
                                        <i class="fas fa-download mr-2"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-4 mt-12">
                        <div class="w-full px-4">
                            <div class="bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-xl p-12 text-center text-white">
                                <h3 class="text-[32px] font-extrabold mb-4 tracking-tight">
                                    Siap Bergabung dengan KKN International?
                                </h3>
                                <p class="text-base mb-8 opacity-95">
                                    Daftarkan diri Anda sekarang dan mulai perjalanan global Anda bersama kami
                                </p>
                                @auth
                                    @if(auth()->user()->role === 'mahasiswa')
                                        <a href="{{ route('mahasiswa.dashboard') }}" class="inline-block px-8 py-3.5 text-[15px] font-semibold rounded-md bg-white text-[#2d3b7f] hover:bg-gray-100 transition-colors">
                                            <i class="fas fa-arrow-right mr-2"></i> Ke Dashboard
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('register.mahasiswa') }}" class="inline-block px-8 py-3.5 text-[15px] font-semibold rounded-md bg-white text-[#2d3b7f] hover:bg-gray-100 transition-colors mr-3">
                                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                                    </a>
                                    <a href="{{ route('login') }}" class="inline-block px-8 py-3.5 text-[15px] font-semibold rounded-md border-2 border-white text-white hover:bg-white/10 transition-colors">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Contact Section -->
                <section class="py-16 bg-gray-50 -mx-4 px-4">
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                            <div class="text-center">
                                <i class="fas fa-envelope text-5xl mb-4 text-[#2d3b7f]"></i>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2.5">Email</h5>
                                <p class="text-gray-600 text-[15px] m-0">international@usm.ac.id</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                            <div class="text-center">
                                <i class="fas fa-phone text-5xl mb-4 text-green-600"></i>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2.5">Telepon</h5>
                                <p class="text-gray-600 text-[15px] m-0">(024) 1234567</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4">
                            <div class="text-center">
                                <i class="fas fa-map-marker-alt text-5xl mb-4 text-red-600"></i>
                                <h5 class="font-bold text-[#2d3b7f] text-lg mb-2.5">Alamat</h5>
                                <p class="text-gray-600 text-[15px] m-0">Gedung Rektorat Lt. 3, Kampus Utama</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
// Smooth scroll untuk sidebar navigation
document.querySelectorAll('.sidebar-nav-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        document.querySelectorAll('.sidebar-nav-item').forEach(link => {
            link.classList.remove('active');
            link.classList.remove('text-[#2d3b7f]');
            link.classList.remove('border-[#F9B234]');
            link.classList.remove('bg-gray-50');
        });
        
        // Add active class to clicked item
        this.classList.add('active');
        this.classList.add('text-[#2d3b7f]');
        this.classList.add('border-[#F9B234]');
        this.classList.add('bg-gray-50');
        
        // Smooth scroll to section
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

// Update active nav on scroll
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('.content-section, section[id]');
    const navItems = document.querySelectorAll('.sidebar-nav-item');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 150;
        if (window.pageYOffset >= sectionTop) {
            current = section.getAttribute('id');
        }
    });
    
    navItems.forEach(item => {
        item.classList.remove('active');
        item.classList.remove('text-[#2d3b7f]');
        item.classList.remove('border-[#F9B234]');
        item.classList.remove('bg-gray-50');
        
        if (item.getAttribute('href') === '#' + current) {
            item.classList.add('active');
            item.classList.add('text-[#2d3b7f]');
            item.classList.add('border-[#F9B234]');
            item.classList.add('bg-gray-50');
        }
    });
});
</script>

@endsection