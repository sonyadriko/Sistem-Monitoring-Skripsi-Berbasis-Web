<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanJudul extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_judul';

    protected $fillable = [
        'users_id',
        'bidang_ilmu_id',
        'mk_pilihan',
        'judul',
        'status',
        'alasan',
        'jumlah_pengajuan',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_pengajuan_judul';
}