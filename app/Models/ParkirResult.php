<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkirResult extends Model
{
    protected $table = 'parkir_results';
    protected $fillable = ['nama', 'tahun_kendaraan', 'zona_pilihan', 'waktu_tempuh', 'label_hasil', 'jam_datang', 'rating', 'ulasan'];
}
