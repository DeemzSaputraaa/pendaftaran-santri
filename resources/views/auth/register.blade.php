<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Santri Baru - Pendaftaran Al-Hikmah</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { fontFamily: { sans: ['Outfit', 'sans-serif'] } }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-blue-500 selection:text-white">

    <div class="min-h-screen flex flex-col md:flex-row-reverse">
        <!-- Image Section -->
        <div class="hidden md:block md:w-[45%] relative">
             <img src="https://images.unsplash.com/photo-1542810634-71277d95dc8f?q=80&w=1000&auto=format&fit=crop" onerror="this.src='https://plus.unsplash.com/premium_photo-1678129080782-42fe1e4ff04f?q=80&w=1000&auto=format&fit=crop'" alt="Islamic Study BG" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
            <div class="absolute bottom-12 left-12 right-12 text-white">
                <h2 class="text-3xl font-bold mb-4">Langkah Awal Generasi Terbaik.</h2>
                <p class="text-slate-200">Mulailah dengan membuat akun wali/calon santri, lalu selesaikan administrasi tanpa harus datang ke pesantren.</p>
            </div>
            <a href="/" class="absolute top-8 right-8 flex items-center gap-2 text-white/80 hover:text-white transition-colors bg-black/20 hover:bg-black/40 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">
                Kembali ke Beranda
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </a>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-[55%] flex flex-col justify-center p-8 lg:px-16 bg-white overflow-y-auto">
            <div class="w-full max-w-lg mx-auto py-8">
                <!-- Mobile only back button -->
                <a href="/" class="md:hidden flex items-center gap-2 text-slate-500 hover:text-blue-600 transition-colors mb-8 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Beranda
                </a>

                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Buat Akun Pendaftaran</h1>
                    <p class="text-slate-500">Masukkan data dasar akun. Pastikan alamat Email aktif dan Password mudah Anda ingat.</p>
                </div>

                <!-- Registration Form -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/register" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai Akta)</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="Nama Calon Santri" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon/WA Aktif</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="0812xxxx" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="email@user.com" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="Ketik ulang password" required>
                        </div>
                    </div>

                    <div class="flex items-start mt-4">
                        <input type="checkbox" name="terms" id="terms" class="mt-1 w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500 outline-none" required>
                        <label for="terms" class="ml-3 text-sm text-slate-600">
                            Saya menyetujui semua <a href="#" class="text-blue-600 underline">Syarat dan Ketentuan</a> pendaftaran santri baru Pesantren Al-Hikmah.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-colors shadow-lg shadow-blue-600/30 hover:shadow-xl hover:-translate-y-0.5 mt-8">
                        Daftar dan Buat Akun
                    </button>
                    
                    <p class="text-center text-sm text-slate-600 mt-6">
                        Sudah punya akun? 
                        <a href="/login" class="font-bold text-blue-600 hover:underline">Masuk sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
