<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{

    protected $table = 'tema';
   

    protected $fillable = [
        'nama',
        'npm',
        'user_id',
        'bidang_ilmu_id',
        'mk_pilihan',
        'judul',
        'status',
        'dosen',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_tema';
}
