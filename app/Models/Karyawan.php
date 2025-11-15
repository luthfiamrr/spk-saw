<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = [
        'nip',
        'nama_lengkap',
        'email',
        'departemen_id',
        'jabatan_id',
        'tgl_bergabung'
    ];

    protected $casts = [
        'tgl_bergabung' => 'date'
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function matriksPenilaian()
    {
        return $this->hasMany(MatriksPenilaian::class, 'karyawan_id');
    }

    public function hasilPenilaian()
    {
        return $this->hasMany(HasilPenilaian::class, 'karyawan_id');
    }
}
