<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarProposal extends Model
{
    protected $table = 'seminar_proposal';

    protected $fillable = [
        // 'nama',
        // 'npm',
        'file_proposal',
        'file_slip_pembayaran',
        'dosen_penguji_1',
        'dosen_penguji_2',
        'ruangan',
        'tanggal',
        'jam',
        'cetak',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_seminar_proposal';

}
