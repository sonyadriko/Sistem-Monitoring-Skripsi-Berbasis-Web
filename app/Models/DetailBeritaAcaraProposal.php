<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBeritaAcaraProposal extends Model
{
    protected $table = 'detail_berita_acara_proposal';

    protected $fillable = [
        'users_id',
        'presensi',
        'revisi',
        'nilai',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_berita_acara_p';
}
