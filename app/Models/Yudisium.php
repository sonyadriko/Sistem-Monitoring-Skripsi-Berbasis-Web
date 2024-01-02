<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yudisium extends Model
{
    protected $table = 'yudisium';

    protected $fillable = [
        'users_id',
        'tanggal_surat_tugas',
        'tanggal_sidang_skripsi',
        'skor_tefl',
        'sertifikat_tefl',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_yudisium';
}
