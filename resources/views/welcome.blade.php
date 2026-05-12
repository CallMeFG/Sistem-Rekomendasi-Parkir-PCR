<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Parkir PCR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 min-h-screen font-sans">
    <nav class="bg-blue-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold"><i class="fas fa-parking mr-2"></i> Parkir Smart PCR</h1>
            <span class="text-sm opacity-80">Politeknik Caltex Riau</span>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10">
        <div class="max-w-2xl mx-auto">
            @if (session('success'))
                <div class="mb-10 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden fade-in-up">
                    <div class="h-2 bg-blue-600"></div>

                    <div class="p-8 md:p-12">
                        <div class="mb-6">
                            <h3 class="text-3xl font-black text-gray-900 tracking-tight italic">
                                Halo, <span class="text-blue-600 not-italic">{{ session('nama') }}</span>
                            </h3>
                            <div class="h-1.5 w-12 bg-yellow-400 mt-2 rounded-full"></div>
                        </div>

                        <div class="mb-8">
                            <p class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.3em] mb-3">Hasil
                                Klasifikasi Algoritma:</p>
                            <div class="bg-blue-600 p-6 md:p-8 rounded-2xl shadow-xl shadow-blue-100">
                                <h2
                                    class="text-white text-xl md:text-2xl font-black uppercase tracking-tight leading-tight">
                                    @php
                                        $allText = session('success');
                                        $lines = explode("\n", $allText);
                                        $labelDitemukan = '';

                                        foreach ($lines as $line) {
                                            $cleanLine = trim(
                                                str_replace(
                                                    ['###', '**', 'Label =', 'Label:', 'REKOMENDASI:'],
                                                    '',
                                                    $line,
                                                ),
                                            );

                                            // Logika: Ambil baris yang mengandung informasi Zona atau Jenis Kendaraan
                                            if (
                                                preg_match('/Motor|Mobil|Zona|Samping|Belakang|Depan|GSG/i', $cleanLine)
                                            ) {
                                                $labelDitemukan = $cleanLine;
                                                break;
                                            }
                                        }

                                        // Jika tetap tidak ketemu, ambil baris pertama yang punya teks
                                        if (empty($labelDitemukan)) {
                                            foreach ($lines as $line) {
                                                if (!empty(trim($line)) && !str_contains($line, 'Kondisi Parkir')) {
                                                    $labelDitemukan = str_replace(['###', '**'], '', $line);
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    {{-- Menampilkan Label --}}
                                    {{ trim($labelDitemukan) }}
                                </h2>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50 p-6 md:p-8 rounded-2xl border border-gray-100">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 text-2xl mr-4 mt-1"></i>
                                    <div class="text-gray-700 text-lg leading-relaxed text-justify font-medium">
                                        @php
                                            // Menampilkan seluruh teks asli namun dibersihkan dari simbol markdown
                                            $penjelasan = str_replace(['###', '**'], '', $allText);
                                        @endphp
                                        {!! nl2br(e(trim($penjelasan))) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                                <div class="bg-white p-2 rounded-lg shadow-sm mr-4 text-blue-600">
                                    <i class="fas fa-lock text-sm"></i>
                                </div>
                                <p class="text-blue-800 text-[11px] font-bold uppercase tracking-wider">
                                    Sistem Parkir PCR: Keamanan adalah prioritas. Gunakan kunci ganda.
                                </p>
                            </div>

                            @if (session('result_id') && !session('rating_success'))
                                <div
                                    class="mt-6 p-6 border border-gray-100 rounded-2xl bg-white shadow-sm text-center fade-in-up">
                                    <p class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">Bagaimana
                                        pengalaman Anda menggunakan sistem kami?
                                    </p>

                                    <form action="{{ route('parkir.rating', session('result_id')) }}" method="POST">
                                        @csrf
                                        <div class="flex justify-center gap-2 flex-row-reverse mb-4">
                                            <input type="radio" id="star5" name="rating" value="5"
                                                class="peer hidden" required />
                                            <label for="star5"
                                                class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 text-3xl transition"><i
                                                    class="fas fa-star"></i></label>

                                            <input type="radio" id="star4" name="rating" value="4"
                                                class="peer hidden" />
                                            <label for="star4"
                                                class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 text-3xl transition"><i
                                                    class="fas fa-star"></i></label>

                                            <input type="radio" id="star3" name="rating" value="3"
                                                class="peer hidden" />
                                            <label for="star3"
                                                class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 text-3xl transition"><i
                                                    class="fas fa-star"></i></label>

                                            <input type="radio" id="star2" name="rating" value="2"
                                                class="peer hidden" />
                                            <label for="star2"
                                                class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 text-3xl transition"><i
                                                    class="fas fa-star"></i></label>

                                            <input type="radio" id="star1" name="rating" value="1"
                                                class="peer hidden" />
                                            <label for="star1"
                                                class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 text-3xl transition"><i
                                                    class="fas fa-star"></i></label>
                                        </div>

                                        <textarea name="ulasan" placeholder="Ada komentar tambahan? (Opsional)"
                                            class="w-full text-sm p-3 border border-gray-200 bg-gray-50 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none mb-4"
                                            rows="2"></textarea>

                                        <button type="submit"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-xl transition w-full text-sm shadow-sm">
                                            <i class="fas fa-paper-plane mr-1"></i> Kirim Penilaian
                                        </button>
                                    </form>
                                </div>
                            @elseif(session('rating_success'))
                                <div
                                    class="mt-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-center font-semibold text-sm fade-in-up">
                                    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('rating_success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <style>
                    .fade-in-up {
                        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
                    }

                    @keyframes fadeInUp {
                        from {
                            opacity: 0;
                            transform: translateY(40px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
            @endif

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-yellow-400 p-6">
                    <h2 class="text-blue-900 font-bold text-2xl">Cek Lokasi Parkirmu</h2>
                    <p class="text-blue-800 opacity-80">Masukkan detail kendaraan untuk hasil yang akurat.</p>
                </div>

                <form action="{{ route('parkir.check') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama Anda"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tahun Kendaraan</label>
                            <select name="tahun"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option>2020 - 2025</option>
                                <option>2015 - 2020</option>
                                <option>2010 - 2015</option>
                                <option>
                                    < 2010</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Waktu Tempuh</label>
                            <select name="waktu"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="< 10 menit">&lt; 10 menit</option>
                                <option value="10 menit- 20 menit">10 menit- 20 menit</option>
                                <option value="20 menit - 30 menit">20 menit - 30 menit</option>
                                <option value="> 30 menit">> 30 menit</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 uppercase text-xs tracking-widest">Jam
                            Kedatangan</label>
                        <input type="time" name="jam_datang"
                            class="w-full px-4 py-3 border-2 border-gray-100 bg-gray-50 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Zona Parkir Tujuan</label>
                        <select name="zona"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option>Belakang Gedung Utama</option>
                            <option>Samping Gedung Utama</option>
                            <option>Samping Masjid</option>
                            <option>Depan Gedung Utama</option>
                            <option>Area GSG</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 rounded-lg transition duration-300 flex items-center justify-center">
                        <i class="fas fa-search-location mr-2"></i> ANALISA SEKARANG
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-gray-400 text-sm">© 2026 TProject UTS - Sistem Informasi Parkir Berbasis AI
            </p>
        </div>
    </div>
</body>

</html>
