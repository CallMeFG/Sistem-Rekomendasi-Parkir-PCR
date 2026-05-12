<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Parkir PCR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-900 text-white shadow-md p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fas fa-chart-line text-2xl text-yellow-400"></i>
                <h1 class="text-xl font-bold tracking-tight">ADMIN DASHBOARD <span class="font-light opacity-50">|
                        Parkir PCR</span></h1>
            </div>
            <a href="{{ route('home') }}" class="text-sm bg-blue-800 hover:bg-blue-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-external-link-alt mr-2"></i>Lihat Situs
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition font-bold shadow-sm flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Analisa</p>
                <h3 class="text-3xl font-bold text-blue-900">{{ $results->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-semibold uppercase">Rata-rata Rating</p>
                <h3 class="text-3xl font-bold text-yellow-500">
                    {{ number_format($results->avg('rating'), 1) }} <span class="text-lg text-gray-300">/ 5.0</span>
                </h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-sm font-semibold uppercase">Feedback Masuk</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $results->whereNotNull('rating')->count() }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Riwayat Penggunaan & Penilaian</h2>
                <span class="text-xs font-medium bg-blue-100 text-blue-600 px-3 py-1 rounded-full uppercase">Live
                    Data</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-4">Waktu</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Input (Zona/Waktu)</th>
                            <th class="px-6 py-4">Hasil AI</th>
                            <th class="px-6 py-4">Rating</th>
                            <th class="px-6 py-4">Ulasan</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach ($results as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                    {{ $item->created_at->format('d M, H:i') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-800">
                                    {{ $item->nama }}
                                    <p class="text-[10px] text-gray-400 font-normal">Tahun: {{ $item->tahun_kendaraan }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <span class="block font-medium">{{ $item->zona_pilihan }}</span>
                                    <span class="text-xs opacity-60 italic">{{ $item->waktu_tempuh }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold border border-blue-100">
                                        {{ Str::limit($item->label_hasil, 25) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->rating)
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="{{ $i <= $item->rating ? 'fas' : 'far' }} fa-star text-[10px]"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <span class="text-gray-300 italic text-xs">Belum dinilai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                    {{ $item->ulasan ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-400 hover:text-red-600 transition">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($results->isEmpty())
                <div class="p-20 text-center text-gray-400">
                    <i class="fas fa-folder-open text-4xl mb-4 block"></i>
                    Belum ada data analisa masuk.
                </div>
            @endif
        </div>
    </main>

    <footer class="text-center py-10 text-gray-400 text-xs">
        &copy; 2026 Admin Panel - Sistem Rekomendasi Parkir AI
    </footer>

</body>

</html>
