<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraSkripsi extends Model
{
    protected $table = 'berita_acara_skripsi';

    protected $fillable = [
        'users_id',
        'sidang_skripsi_id',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_berita_acara_s';
}
