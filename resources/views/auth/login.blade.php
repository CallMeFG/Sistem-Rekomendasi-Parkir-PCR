<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
                        <i class="fas fa-parking text-white text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm">Masuk untuk mengakses sistem</p>
                </div>

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-2xl text-sm border border-red-100 flex items-center">
                        <i class="fas fa-circle-exclamation mr-2"></i> {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-50 text-emerald-600 rounded-2xl text-sm border border-emerald-100 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="email@pcr.ac.id" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase ml-1 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-blue-100 active:scale-95">
                        MASUK SEKARANG
                    </button>
                </form>
            </div>
            <div class="bg-slate-50 p-6 text-center border-t border-slate-100 text-sm">
                <span class="text-slate-500">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-blue-600 font-bold ml-1 hover:underline">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
