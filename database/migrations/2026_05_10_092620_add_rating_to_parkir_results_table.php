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
        Schema::table('parkir_results', function (Blueprint $table) {
            $table->integer('rating')->nullable(); // Bintang 1-5
            $table->text('ulasan')->nullable();    // Komentar opsional
        });
    }

    public function down(): void
    {
        Schema::table('parkir_results', function (Blueprint $table) {
            $table->dropColumn(['rating', 'ulasan']);
        });
    }
};
