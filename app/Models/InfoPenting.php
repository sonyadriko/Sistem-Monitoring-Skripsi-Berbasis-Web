<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPenting extends Model
{
    protected $table = 'info_penting';


    protected $fillable = [
        'users_id',
        'judul',
        'isi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_info_penting';
}
