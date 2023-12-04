<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRevisiSidangSkripsi extends Model
{
    protected $table = 'detail_revisi_sidang_skripsi';

    protected $fillable = [
        // 'user_id',
        'revisi_sidang_skripsi_id',
        'file_revisi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_revisi_sidang';
}
