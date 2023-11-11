<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiSidangSkripsi extends Model
{
    protected $table = 'revisi_sidang_skripsi';

    protected $fillable = [
        'berita_acara_skripsi_id',
        'file_revisi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_revisi_sidang_skripsi';
}
