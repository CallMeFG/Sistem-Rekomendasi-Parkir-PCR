<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Smart Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full">
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-blue-100 border border-slate-100 overflow-hidden">

            <div class="h-2 bg-blue-600"></div>

            <div class="p-8">
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200 rotate-3">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Buat Akun Baru</h2>
                    <p class="text-slate-500 text-sm mt-1">Lengkapi data untuk bergabung ke sistem</p>
                </div>

                <form action="{{ route('register.post') }}" method="POST" class="space-y-4" autocomplete="off">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1 tracking-wider">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all duration-200 placeholder-slate-400"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1 tracking-wider">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3.5 bg-slate-50 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all duration-200 placeholder-slate-400"
                            placeholder="nama@example.com" required>
                        @error('email')
                            <p class="text-red-500 text-[10px] mt-1 ml-1 font-medium italic">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1 tracking-wider">Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-3.5 bg-slate-50 border @error('password') border-red-500 @else border-slate-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all duration-200 placeholder-slate-400"
                                placeholder="••••••••" required>
                            <p class="text-[10px] text-slate-400 mt-1 ml-1 font-medium">
                                <i class="fas fa-info-circle mr-1 text-blue-500"></i> Min. 8 karakter
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1 tracking-wider">Konfirmasi</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all duration-200 placeholder-slate-400"
                                placeholder="••••••••" required>
                        </div>
                    </div>

                    @error('password')
                        <p class="text-red-500 text-[10px] mt-1 ml-1 font-medium italic">* {{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-blue-100 active:scale-[0.98] mt-2 flex items-center justify-center">
                        <span>DAFTAR SEKARANG</span>
                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </button>
                </form>
            </div>

            <div class="bg-slate-50 p-6 text-center border-t border-slate-100">
                <p class="text-sm text-slate-600">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}"
                        class="text-blue-600 font-bold hover:text-blue-800 decoration-2 underline-offset-4 hover:underline transition-all">Masuk
                        di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-slate-400 text-xs mt-8">
            &copy; 2026 Smart Parking System • Politeknik Caltex Riau
        </p>
    </div>

</body>

</html>
