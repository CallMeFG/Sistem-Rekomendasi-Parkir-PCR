<?php

namespace App\Services;

class DecisionTreeService
{
    public function predict($data){
        $jam = $data['jam_datang'];
        $zona = $data['zona'];
        $tahun = $data['tahun'];
        $waktu = $data['waktu'];
        $nama = $data['nama'];

        $keamanan = "\n\n💡 Tips Keamanan: Demi kenyamanan bersama, pastikan kendaraan Anda telah dikunci ganda dan hindari meninggalkan barang berharga di area parkir.";
        $headerPadat = "\n\n Kondisi Parkir: Padat ⚠️\n\n Saat ini area parkir utama telah mencapai kapasitas maksimal. Untuk menghemat waktu Anda, kami merekomendasikan untuk langsung menuju **Samping Masjid, Samping GOR, atau Belakang Kantin**. Pilih area yang dekat dengan lokasi tujuan anda.\n\n ";

        $headerNormal = "\n\n Kondisi Parkir: Lancar ✅\n\n Lalu lintas parkir saat ini terpantau normal. Anda disarankan memilih slot parkir yang paling dekat dengan akses pintu masuk gedung tujuan. Berdasarkan data kendaraan Anda, berikut adalah rekomendasi lokasi spesifik:\n\n";

        $label = "";

        if (($zona == 'Belakang Gedung Utama' || $zona == 'Samping Gedung Utama') && 
            ($waktu == '< 10 menit')) {
            if ($tahun == '2020 - 2025' || $tahun == '2015 - 2020') {
                $label = "Motor Modern - Zona Belakang (Jarak Sangat Dekat)";
            }
        }

        if ($label == "" && ($tahun == '2010 - 2015' || $tahun == '< 2010')) {
            $label = "Motor Lama - Zona Samping (Jarak Sedang-Jauh)";
        }

        if ($label == "" && (($zona == 'Depan Gedung Utama' || $zona == 'Area GSG') && 
            ($waktu == '20 menit - 30 menit' || $waktu == '> 30 menit'))) {
            $label = "Pengguna Mobil - Zona Depan (Jarak Jauh)";
        }

        if ($label == "") {
            $label = "Motor Modern - Zona Samping (Jarak Dekat-Sedang)";
        }

        if ($jam >= '07:00' && $jam <= '10:00') {
            return $label . $headerPadat . $keamanan;
        } else {
            return $label. $headerNormal . $label . $keamanan;
        }
    }
}