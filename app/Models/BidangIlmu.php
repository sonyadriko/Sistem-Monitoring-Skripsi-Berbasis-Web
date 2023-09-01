<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangIlmu extends Model
{
    protected $table = 'bidang_ilmu';

    protected $fillable = [
        'topik_bidang_ilmu',
        'mata_kuliah_pendukung',
        'keterangan',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
