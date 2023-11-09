<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganSkripsi extends Model
{
    protected $table = 'bimbingan_skripsi';

    protected $fillable = [
        'bimbingan_proposal_id',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_bimbingan_skripsi';
}
