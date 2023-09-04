<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    protected $table = 'surat_tugas';
   

    protected $fillable = [
        'user_id',
        'detail_users_id',
        'tema_id',
        'dosen_id',
        'tanggal_sidang_proposal',
        'file_proposal',
        'file_slip_pembayaran',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_surat_tugas';
}
