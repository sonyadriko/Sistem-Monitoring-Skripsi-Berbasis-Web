<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBeritaAcaraSkripsi extends Model
{
    protected $table = 'detail_berita_acara_skripsi';

    protected $fillable = [
        'berita_acara_skripsi_id',
        'users_id',
        'presensi',
        'revisi',
        'nilai',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_berita_acara_s';
}
