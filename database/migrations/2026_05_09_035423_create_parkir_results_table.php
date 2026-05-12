<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parkir_results', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tahun_kendaraan'); 
            $table->string('zona_pilihan');    
            $table->string('waktu_tempuh');    
            $table->string('jam_datang');
            $table->text('label_hasil');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir_results');
    }
};
