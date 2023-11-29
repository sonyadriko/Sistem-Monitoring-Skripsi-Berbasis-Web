<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperBidangIlmu extends Model
{
    protected $table = 'paper_bidang_ilmu';


    protected $fillable = [
        'bidang_ilmu_id',
        'file',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_paper_bidang_ilmu';
}
