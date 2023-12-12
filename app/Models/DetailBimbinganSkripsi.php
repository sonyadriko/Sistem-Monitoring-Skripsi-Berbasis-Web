<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBimbinganSkripsi extends Model
{
    protected $table = 'detail_bimbingan_skripsi';

    protected $fillable = [
        // 'users_id',
        'bimbingan_skripsi_id',
        'file',
        'revisi',
        // 'validasi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_bimbingan_skripsi';
}
