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
                <a href="#tentang" class="sidebar-nav-item active block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Tentang Program</a>
                <a href="#tujuan-manfaat" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Tujuan & Manfaat</a>
                <a href="#persyaratan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Persyaratan</a>
                <a href="#negara-tujuan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Negara Tujuan</a>
                <a href="#luaran" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Luaran Program</a>
                <a href="#panduan" class="sidebar-nav-item block py-4 px-8 text-base font-semibold text-gray-800 no-underline border-l-4 border-transparent transition-all tracking-wide hover:text-[#2d3b7f] hover:border-[#F9B234] hover:bg-gray-50">Panduan & Dokumen</a>
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
                        dengan masyarakat global, menerapkan ilmu pengetahuan dalam konteks internasional, dan mengembangkan kepekaan terhadap 
                        isu-isu sosial lintas budaya.
                    </p>

                    <div class="bg-gradient-to-r from-[#2d3b7f] to-[#1f2a5a] text-white rounded-xl p-8 mb-8">
                        <h4 class="text-[22px] font-bold mb-4 tracking-tight">✨ Program Unggulan</h4>
                        <p class="text-[15px] leading-relaxed opacity-95 mb-4">
                            KKN International merupakan kesempatan emas bagi mahasiswa USM untuk mengikuti program pengabdian masyarakat 
                            di berbagai negara mitra dengan fokus pada pendidikan, pemberdayaan masyarakat, dan pengembangan kompetensi global.
                        </p>
                        <p class="text-[15px] leading-relaxed opacity-95">
                            Selama program berlangsung, mahasiswa akan bekerja sama dengan lembaga mitra internasional, mengajar di sekolah-sekolah, 
                            dan melaksanakan berbagai kegiatan pengabdian yang disesuaikan dengan kebutuhan masyarakat setempat.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 my-12">
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">8+</div>
                            <div class="text-[15px] font-semibold text-gray-600">Negara Mitra</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">25+</div>
                            <div class="text-[15px] font-semibold text-gray-600">Lokasi Pengabdian</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">300+</div>
                            <div class="text-[15px] font-semibold text-gray-600">Alumni Peserta</div>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-extrabold text-[#2d3b7f] leading-none mb-2.5">4-6</div>
                            <div class="text-[15px] font-semibold text-gray-600">Minggu Program</div>
                        </div>
                    </div>
                </section>

                <!-- Tujuan & Manfaat Section -->
                <section id="tujuan-manfaat" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Tujuan & Manfaat Program</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Program KKN International dirancang dengan tujuan strategis untuk mengembangkan mahasiswa menjadi individu yang 
                        memiliki wawasan global dan kepekaan sosial internasional.
                    </p>

                    <div class="flex flex-wrap -mx-4 mt-12">
                        <div class="w-full md:w-1/2 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-lg p-8 h-full transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">🎯 Tujuan Program</h4>
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
                            <div class="bg-white border border-gray-300 rounded-lg p-8 h-full transition-all hover:shadow-[0_8px_20px_rgba(45,59,127,0.1)] hover:border-[#2d3b7f]">
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight">🌟 Manfaat bagi Mahasiswa</h4>
                                <ul class="list-none p-0 m-0">
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pengalaman pengabdian masyarakat internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pemahaman mendalam tentang budaya global</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Peningkatan kemampuan bahasa asing secara praktis</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Pengembangan soft skills dan leadership</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Networking dengan organisasi internasional</li>
                                    <li class="text-[15px] text-gray-800 py-2.5 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-2 before:text-green-600 before:font-bold before:text-lg">Sertifikat yang meningkatkan nilai CV</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Persyaratan Section -->
                <section id="persyaratan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Persyaratan Peserta</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Untuk mengikuti program KKN International, mahasiswa harus memenuhi beberapa persyaratan akademik dan non-akademik.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="bg-white border-2 border-[#2d3b7f] rounded-xl p-8 hover:shadow-[0_8px_30px_rgba(45,59,127,0.15)] transition-all">
                            <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">📋 Persyaratan Akademik</h4>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Mahasiswa aktif minimal semester 6</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">IPK minimal 3.00</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Kemampuan bahasa Inggris baik (TOEFL min. 450 atau setara)</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Aktif dalam kegiatan akademik/kemahasiswaan</li>
                            </ul>
                        </div>

                        <div class="bg-white border-2 border-[#2d3b7f] rounded-xl p-8 hover:shadow-[0_8px_30px_rgba(45,59,127,0.15)] transition-all">
                            <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">👤 Persyaratan Non-Akademik</h4>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Sehat jasmani dan rohani</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Memiliki motivasi tinggi untuk mengabdi di luar negeri</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Bersedia mengikuti pembekalan KKN International</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Mampu beradaptasi dengan budaya baru</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['✓'] before:absolute before:left-0 before:top-0 before:text-[#F9B234] before:font-black before:text-xl">Memiliki paspor yang masih berlaku</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-[#2d3b7f] p-6 rounded-r-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-[#2d3b7f] text-xl mr-3 mt-1"></i>
                            <div>
                                <p class="text-[15px] text-gray-800 leading-relaxed m-0">
                                    <strong class="text-[#2d3b7f]">Catatan Penting:</strong> Mahasiswa yang lolos seleksi wajib mengikuti 
                                    pembekalan intensif yang mencakup materi budaya, bahasa, dan teknis pengabdian masyarakat internasional.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Negara Tujuan Section -->
                <section id="negara-tujuan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Negara Tujuan & Kegiatan</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        KKN International dilaksanakan di berbagai negara mitra dengan fokus kegiatan pengabdian masyarakat yang beragam 
                        sesuai dengan kebutuhan lokal dan bidang keahlian mahasiswa.
                    </p>

                    <div class="flex flex-wrap -mx-4 mt-8">
                        <!-- Malaysia -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-graduation-cap text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇲🇾 Malaysia</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    <strong>Lokasi:</strong> Kuala Lumpur<br>
                                    <strong>Mitra:</strong> Sanggar Belajar (SB) untuk anak-anak PMI<br>
                                    <strong>Kegiatan:</strong> Pendidikan calistung, edukasi interaktif, program pemberdayaan anak usia 4-15 tahun
                                </p>
                            </div>
                        </div>

                        <!-- Thailand -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-school text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇹🇭 Thailand</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    <strong>Lokasi:</strong> Hat Yai, Thailand Selatan<br>
                                    <strong>Mitra:</strong> Alhidayah Waqaf Foundation<br>
                                    <strong>Kegiatan:</strong> Mengajar di sekolah TK-SMA, pengembangan pendidikan, pengabdian masyarakat
                                </p>
                            </div>
                        </div>

                        <!-- Filipina -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-hands-helping text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇵🇭 Filipina</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Program kesehatan, sanitasi, dan peningkatan ekonomi masyarakat di daerah pedesaan
                                </p>
                            </div>
                        </div>

                        <!-- Vietnam -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-heartbeat text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇻🇳 Vietnam</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Program kesehatan masyarakat dan pemberdayaan ekonomi kerakyatan
                                </p>
                            </div>
                        </div>

                        <!-- Kamboja -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-cogs text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇰🇭 Kamboja</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Pengembangan teknologi tepat guna dan pendidikan vokasional
                                </p>
                            </div>
                        </div>

                        <!-- Myanmar -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-white border border-gray-300 rounded-xl p-8 h-full text-center transition-all hover:shadow-[0_12px_30px_rgba(45,59,127,0.12)] hover:border-[#2d3b7f] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#2d3b7f] to-[#1f2a5a] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-tools text-3xl text-white"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-3 tracking-tight">🇲🇲 Myanmar</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Program pendidikan keterampilan dan pemberdayaan masyarakat pedesaan
                                </p>
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

                <!-- Luaran Program Section -->
                <section id="luaran" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Luaran Program</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Setiap peserta KKN International diwajibkan menghasilkan luaran yang dapat dipertanggungjawabkan secara akademik 
                        dan berkontribusi terhadap pengembangan ilmu pengetahuan.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Luaran Mahasiswa -->
                        <div class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 rounded-xl p-8 hover:shadow-xl transition-all">
                            <div class="flex items-center mb-5">
                                <div class="w-12 h-12 bg-[#2d3b7f] rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-user-graduate text-white text-xl"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-[#2d3b7f] tracking-tight m-0">Luaran untuk Mahasiswa</h4>
                            </div>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📝'] before:absolute before:left-0 before:top-0">
                                    <strong>Laporan Individu</strong> yang ditandatangani oleh pemimpin sekolah/lembaga mitra
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📄'] before:absolute before:left-0 before:top-0">
                                    <strong>Jurnal Pengabdian</strong> dengan pendampingan dosen untuk publikasi
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📊'] before:absolute before:left-0 before:top-0">
                                    <strong>Proposal Program Kerja</strong> sesuai jurusan masing-masing
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📸'] before:absolute before:left-0 before:top-0">
                                    <strong>Dokumentasi Kegiatan</strong> yang komprehensif
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['🎓'] before:absolute before:left-0 before:top-0">
                                    <strong>Sertifikat KKN International</strong> dari universitas dan lembaga mitra
                                </li>
                            </ul>
                        </div>

                        <!-- Luaran Dosen -->
                        <div class="bg-gradient-to-br from-green-50 to-white border-2 border-green-200 rounded-xl p-8 hover:shadow-xl transition-all">
                            <div class="flex items-center mb-5">
                                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                                </div>
                                <h4 class="text-[22px] font-bold text-green-700 tracking-tight m-0">Luaran untuk Dosen PkM</h4>
                            </div>
                            <ul class="list-none p-0 m-0 space-y-3">
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📚'] before:absolute before:left-0 before:top-0">
                                    <strong>Artikel Jurnal</strong> untuk publikasi di Jurnal Nasional Terakreditasi minimal SINTA 4
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['📋'] before:absolute before:left-0 before:top-0">
                                    <strong>Laporan PkM</strong> sesuai ketentuan LPPM USM
                                </li>
                                <li class="text-[15px] text-gray-800 pl-7 relative leading-relaxed before:content-['🤝'] before:absolute before:left-0 before:top-0">
                                    <strong>Dokumentasi Pendampingan</strong> mahasiswa di lapangan
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 bg-white border-2 border-[#2d3b7f] rounded-xl p-8">
                        <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-4 tracking-tight flex items-center">
                            <i class="fas fa-clipboard-check mr-3 text-[#F9B234]"></i>
                            Panduan Penyusunan Luaran
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-bold text-gray-800 mb-2">Format Proposal Program:</h5>
                                <ul class="text-sm text-gray-600 space-y-1 ml-5">
                                    <li>• Judul kegiatan yang jelas dan spesifik</li>
                                    <li>• Tujuan kegiatan (fokus pada satu tujuan utama)</li>
                                    <li>• Deskripsi singkat kegiatan</li>
                                    <li>• Sasaran program</li>
                                    <li>• Metode pelaksanaan</li>
                                    <li>• Rencana keluaran</li>
                                    <li>• Biodata singkat pengusul</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-2">Contoh Judul Kegiatan:</h5>
                                <ul class="text-sm text-gray-600 space-y-1 ml-5">
                                    <li>• "Peningkatan Kemampuan Calistung Anak PMI melalui Edukasi Interaktif"</li>
                                    <li>• "Pemberdayaan Masyarakat melalui Literasi Digital"</li>
                                    <li>• "Pengembangan Kreativitas Anak melalui Seni dan Kerajinan"</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Panduan & Dokumen Section -->
                <section id="panduan" class="mb-20 scroll-mt-[100px]">
                    <h2 class="text-4xl font-extrabold text-black mb-2 tracking-tight border-b-4 border-[#F9B234] inline-block pb-2 max-md:text-3xl">Panduan & Dokumen</h2>
                    <p class="text-base text-gray-600 leading-relaxed mb-8">
                        Download berbagai panduan dan dokumen penting untuk persiapan KKN International Anda.
                    </p>

                    <!-- Dokumen yang Perlu Disiapkan -->
                    <div class="mb-8">
                        <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">📋 Dokumen yang Perlu Disiapkan</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white border border-gray-300 rounded-lg p-5 hover:border-[#2d3b7f] transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-passport text-2xl text-[#2d3b7f] mr-4 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 mb-1">Dokumen Identitas</h5>
                                        <p class="text-sm text-gray-600 m-0">Paspor, KTP, dan dokumen identitas lain yang selalu dibawa dan dijaga</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg p-5 hover:border-[#2d3b7f] transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-plane-departure text-2xl text-[#2d3b7f] mr-4 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 mb-1">Tiket Perjalanan</h5>
                                        <p class="text-sm text-gray-600 m-0">Print out tiket pesawat pulang-pergi dan bukti booking akomodasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg p-5 hover:border-[#2d3b7f] transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-file-signature text-2xl text-[#2d3b7f] mr-4 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 mb-1">Surat Tugas & LoA</h5>
                                        <p class="text-sm text-gray-600 m-0">Surat tugas dari universitas dan Letter of Acceptance dari lembaga mitra</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg p-5 hover:border-[#2d3b7f] transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-shield-alt text-2xl text-[#2d3b7f] mr-4 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 mb-1">Dokumen Asuransi</h5>
                                        <p class="text-sm text-gray-600 m-0">Dokumen asuransi perjalanan dan kesehatan internasional</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Perlengkapan yang Perlu Dibawa -->
                    <div class="mb-8">
                        <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">🎒 Perlengkapan yang Perlu Dibawa</h4>
                        <div class="bg-gradient-to-r from-[#f8f9fa] to-white border-l-4 border-[#F9B234] rounded-r-lg p-6">
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 m-0 p-0 list-none">
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">International adaptor dan powerbank</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">Obat-obatan pribadi dan multivitamin</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">Baju batik dan almamater USM</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">Pakaian sopan dan tertutup (baju taqwa untuk wanita)</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">Perlengkapan pribadi sehari-hari</li>
                                <li class="text-[15px] text-gray-800 pl-7 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold before:text-lg">Uang tunai dalam mata uang negara tujuan</li>
                            </ul>
                            <div class="mt-4 text-sm text-gray-600 italic">
                                <i class="fas fa-exclamation-triangle text-[#F9B234] mr-2"></i>
                                <strong>Catatan:</strong> Powerbank dan kabel charge tidak boleh dimasukkan ke bagasi, harus dibawa di tas kabin.
                            </div>
                        </div>
                    </div>

                    <!-- Tips Penting -->
                    <div class="mb-8">
                        <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-5 tracking-tight">💡 Tips Penting</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white border-2 border-blue-100 rounded-lg p-5 hover:border-blue-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-suitcase-rolling text-xl text-blue-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Kemas Efisien</h5>
                                        <p class="text-xs text-gray-600 m-0">Pilih pakaian multifungsi dan mudah dipadupadankan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-green-100 rounded-lg p-5 hover:border-green-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-language text-xl text-green-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Pelajari Bahasa</h5>
                                        <p class="text-xs text-gray-600 m-0">Kuasai frasa dasar bahasa lokal untuk interaksi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-purple-100 rounded-lg p-5 hover:border-purple-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-heart text-xl text-purple-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Hormati Budaya</h5>
                                        <p class="text-xs text-gray-600 m-0">Patuhi adat istiadat dan aturan setempat</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-red-100 rounded-lg p-5 hover:border-red-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-heartbeat text-xl text-red-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Jaga Kesehatan</h5>
                                        <p class="text-xs text-gray-600 m-0">Konsumsi makanan bersih dan istirahat cukup</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-yellow-100 rounded-lg p-5 hover:border-yellow-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-check-double text-xl text-yellow-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Checklist</h5>
                                        <p class="text-xs text-gray-600 m-0">Buat daftar pengecekan agar tidak ada yang tertinggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-orange-100 rounded-lg p-5 hover:border-orange-300 transition-all">
                                <div class="flex items-start">
                                    <i class="fas fa-users text-xl text-orange-600 mr-3 mt-1"></i>
                                    <div>
                                        <h5 class="font-bold text-gray-800 text-sm mb-2">Networking</h5>
                                        <p class="text-xs text-gray-600 m-0">Bangun relasi dengan peserta dan masyarakat lokal</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Download Brosur -->
                    <div class="bg-white border-2 border-[#2d3b7f] rounded-xl p-8 hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between flex-wrap gap-6">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mr-5">
                                    <i class="fas fa-file-pdf text-4xl text-red-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-[22px] font-bold text-[#2d3b7f] mb-2 tracking-tight">Guidebook KKN International</h4>
                                    <p class="text-sm text-gray-600 m-0">
                                        Panduan lengkap tentang program, lokasi, kegiatan, persyaratan, dan tips persiapan KKN International
                                    </p>
                                </div>
                            </div>
                            <a href="#" class="px-8 py-3.5 text-[15px] font-semibold rounded-lg bg-[#2d3b7f] text-white hover:bg-[#1f2a5a] transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-download mr-2"></i> Download Guidebook
                            </a>
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
                                <p class="text-gray-600 text-[15px] m-0">kui@usm.ac.id</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-phone text-3xl text-green-600"></i>
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
    const sections = document.querySelectorAll('section[id]');
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