<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangSkripsi extends Model
{
    protected $table = 'sidang_skripsi';

    protected $fillable = [
        'users_id',
        'bimbingan_skripsi_id',
        'file_skripsi',
        'file_slip_pembayaran',
        'dosen_penguji_1',
        'dosen_penguji_2',
        'dosen_penguji_3',
        'sekretaris',
        'ruangan',
        'tanggal',
        'jam',
        'status',
        'cetak',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_sidang_skripsi';
}
