<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $table = 'detail_users';
   

    protected $fillable = [
        'alamat_mhs',
        'no_telp_mhs',
        'alamat_orang_tua',
        'no_telp_orang_tua',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
