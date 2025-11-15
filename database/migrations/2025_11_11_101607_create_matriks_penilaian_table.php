<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriks_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode_penilaian')->onDelete('cascade');
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->decimal('nilai_mentah', 8, 2);
            $table->timestamps();

            // Pastikan kombinasi unik
            $table->unique(['periode_id', 'karyawan_id', 'kriteria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriks_penilaian');
    }
};
