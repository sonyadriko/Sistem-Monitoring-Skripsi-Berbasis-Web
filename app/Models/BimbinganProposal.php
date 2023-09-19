<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganProposal extends Model
{
    protected $table = 'bimbingan_proposal';

    protected $fillable = [
        // 'user_id',
        // 'tema_id',
        'dosen_pembimbing_utama',
        'dosen_pembimbing_ii',
        'acc_dosen_utama',
        'tgl_acc_dosen_utama',
        'acc_dosen_ii',
        'tgl_acc_dosen_ii',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_bimbingan_proposal';
}
