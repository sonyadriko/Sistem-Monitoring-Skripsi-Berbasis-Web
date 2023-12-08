<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBidangIlmu extends Model
{
    protected $table = 'detail_bidang_ilmu';

    protected $fillable = [
        'bidang_ilmu_id',
        'users_id',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_bidang_ilmu';
}
