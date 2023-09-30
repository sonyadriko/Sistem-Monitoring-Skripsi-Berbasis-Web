<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{

    protected $table = 'tema';
   

    protected $fillable = [
        'user_id',
        'bidang_ilmu_id',
        'status',
        'dosen',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_tema';
}
