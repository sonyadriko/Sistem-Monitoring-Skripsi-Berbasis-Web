<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahPendukung extends Model
{
    protected $table = 'mata_kuliah_pendukung';


    protected $fillable = [
        'nama_mata_kuliah',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_mata_kuliah_pendukung';
}
