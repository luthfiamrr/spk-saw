<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode_penilaian')->onDelete('cascade');
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->decimal('skor_akhir', 10, 6);
            $table->integer('ranking');
            $table->timestamps();

            $table->unique(['periode_id', 'karyawan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian');
    }
};
