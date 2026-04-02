<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Pendaftaran Santri Baru</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
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

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Image Section -->
        <div class="hidden md:block md:w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1542810634-71277d95dc8f?q=80&w=1000&auto=format&fit=crop" onerror="this.src='https://plus.unsplash.com/premium_photo-1678129080782-42fe1e4ff04f?q=80&w=1000&auto=format&fit=crop'" alt="Islamic Study BG" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
            <div class="absolute bottom-12 left-12 right-12 text-white">
                <h2 class="text-3xl font-bold mb-4">Kembali Lanjutkan Proses Pendaftaran.</h2>
                <p class="text-slate-200">Masuk ke akun Anda untuk melihat jadwal wawancara, memperbarui identitas diri, dan memantau status terbaru santri.</p>
            </div>
            <!-- Back to Home -->
            <a href="/" class="absolute top-8 left-8 flex items-center gap-2 text-white/80 hover:text-white transition-colors bg-black/20 hover:bg-black/40 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Mobile only back button -->
                <a href="/" class="md:hidden flex items-center gap-2 text-slate-500 hover:text-blue-600 transition-colors mb-8 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Beranda
                </a>

                <div class="mb-10">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg flex items-center justify-center text-white font-bold text-2xl mb-6">
                        P
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang</h1>
                    <p class="text-slate-500">Silakan masukkan email dan password yang Anda buat pada saat registrasi pendaftaran.</p>
                </div>

                <!-- Real Form -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="contoh@user.com" required>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline">Lupa Password?</a>
                        </div>
                        <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-lg transition-colors shadow-lg hover:shadow-xl hover:-translate-y-0.5 mt-4">
                        Masuk ke Dashboard
                    </button>
                    
                    <p class="text-center text-sm text-slate-600 mt-6">
                        Belum punya akun pendaftaran? 
                        <a href="/register" class="font-bold text-blue-600 hover:underline">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
