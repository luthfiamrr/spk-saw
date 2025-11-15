<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePenilaian extends Model
{
    use HasFactory;

    protected $table = 'periode_penilaian';
    protected $fillable = [
        'nama_periode',
        'tgl_mulai',
        'tgl_selesai',
        'status'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date'
    ];

    public function matriksPenilaian()
    {
        return $this->hasMany(MatriksPenilaian::class, 'periode_id');
    }

    public function hasilPenilaian()
    {
        return $this->hasMany(HasilPenilaian::class, 'periode_id');
    }
}
