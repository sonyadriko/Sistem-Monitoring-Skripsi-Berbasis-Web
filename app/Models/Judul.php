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
        'bidang_ilmu',
        'mk_pilihan',
        'judul',
        'status',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
