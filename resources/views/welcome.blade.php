<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Santri Baru | Pesantren Masa Depan</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .blob-anim {
            animation: blob 7s infinite alternate;
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased overflow-x-hidden selection:bg-blue-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-effect transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg flex items-center justify-center text-white font-bold text-xl">
                        P
                    </div>
                    <div>
                        <h1 class="font-bold text-xl text-slate-900 leading-tight">Pendaftaran</h1>
                        <p class="text-xs text-blue-600 font-medium tracking-wider uppercase">Pesantren Al-Hikmah</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-8 items-center border border-slate-200 px-6 py-2 rounded-full bg-white/60 shadow-sm">
                    <a href="#beranda" class="text-sm font-semibold text-slate-900 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#informasi" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Informasi</a>
                    <a href="#alur" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Alur Pendaftaran</a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/login" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Masuk</a>
                    <a href="/register" class="bg-slate-900 hover:bg-blue-600 text-white px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background decorative blobs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 mix-blend-multiply filter blur-3xl opacity-70 blob-anim z-0"></div>
        <div class="absolute top-40 left-10 w-72 h-72 rounded-full bg-amber-50 mix-blend-multiply filter blur-3xl opacity-80 blob-anim z-0" style="animation-delay: 2s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-semibold mb-6">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                        Gelombang 1 Dibuka
                    </div>
                    <h2 class="text-5xl lg:text-7xl font-serif font-semibold text-slate-900 leading-tight mb-6">
                        Membangun <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-blue-900">Generasi Qur'ani.</span>
                    </h2>
                    <p class="text-lg text-slate-600 font-light mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Bergabunglah bersama kami di Pesantren Al-Hikmah. Kami mencetak santri yang berakhlak mulia, cerdas, dan mandiri dengan sistem pendidikan modern yang terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/register" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-blue-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            Mulai Pendaftaran
                        </a>
                        <a href="#alur" class="group bg-white text-slate-700 border border-slate-200 px-8 py-4 rounded-full font-semibold text-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center justify-center gap-2 shadow-sm">
                            Lihat Panduan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Feature Image/Mockup -->
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl glass-effect p-2 transform rotate-1 hover:rotate-0 transition-transform duration-500">
                        <!-- Fix for broken image -->
                        <img src="https://images.unsplash.com/photo-1542810634-71277d95dc8f?q=80&w=1000&auto=format&fit=crop" onerror="this.src='https://plus.unsplash.com/premium_photo-1678129080782-42fe1e4ff04f?q=80&w=1000&auto=format&fit=crop'" alt="Islamic Study" class="w-full h-[500px] object-cover rounded-2xl opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent rounded-2xl"></div>
                        <div class="absolute bottom-8 left-8 right-8">
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-xl flex items-center gap-4 text-white">
                                <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center font-bold text-xl">🎓</div>
                                <div>
                                    <p class="text-sm font-light">Total Santri Aktif</p>
                                    <p class="font-bold text-xl">1,240+ Santri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Flow Section -->
    <section id="alur" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-2">Pendaftaran Mudah</h3>
                <h2 class="text-4xl font-serif font-bold text-slate-900">Alur Pendaftaran Santri</h2>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto text-lg">Ikuti tahapan sederhana ini untuk mendaftarkan putra-putri Anda. Sistem kami dirancang untuk  memudahkan proses pendaftaran dari rumah.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                <!-- Line connector -->
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-slate-100 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 text-center group">
                    <div class="w-24 h-24 mx-auto bg-slate-50 border-2 border-slate-200 rounded-full flex items-center justify-center mb-6 group-hover:border-blue-500 group-hover:bg-blue-50 transition-colors duration-300">
                        <div class="text-3xl">📝</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">1. Buat Akun</h4>
                    <p class="text-slate-500 text-sm">Daftar dan melengkapi data dasar diri untuk mendapatkan akses masuk.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 text-center group">
                    <div class="w-24 h-24 mx-auto bg-slate-50 border-2 border-slate-200 rounded-full flex items-center justify-center mb-6 group-hover:border-blue-500 group-hover:bg-blue-50 transition-colors duration-300">
                        <div class="text-3xl">💳</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">2. Pembayaran</h4>
                    <p class="text-slate-500 text-sm">Transfer biaya pendaftaran & unggah bukti untuk diverifikasi panitia.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 text-center group">
                    <div class="w-24 h-24 mx-auto bg-slate-50 border-2 border-slate-200 rounded-full flex items-center justify-center mb-6 group-hover:border-blue-500 group-hover:bg-blue-50 transition-colors duration-300">
                        <div class="text-3xl">📁</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">3. Lengkapi Data</h4>
                    <p class="text-slate-500 text-sm">Isi form identitas dan unggah dokumen pendukung pendaftaran.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 text-center group">
                    <div class="w-24 h-24 mx-auto bg-slate-50 border-2 border-slate-200 rounded-full flex items-center justify-center mb-6 group-hover:border-blue-500 group-hover:bg-blue-50 transition-colors duration-300">
                        <div class="text-3xl">🎉</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">4. Evaluasi & Hasil</h4>
                    <p class="text-slate-500 text-sm">Wawancara offline, pantau status pengumuman, dan daftar ulang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-400">
            <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg flex items-center justify-center text-white font-bold text-xl mb-6">
                P
            </div>
            <p class="mb-4">© 2024 Pendaftaran Pesantren Al-Hikmah. Membangun Generasi Rabbani.</p>
            <p class="text-sm">Jalan Pendidikan No. 123, Kota Santri. Email: info@pesantren.ac.id | Telp: (021) 1234567</p>
        </div>
    </footer>

</body>
</html>
