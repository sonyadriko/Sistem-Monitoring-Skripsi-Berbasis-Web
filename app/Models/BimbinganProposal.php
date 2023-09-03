<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganProposal extends Model
{
    protected $table = 'bimbingan_proposal';

    protected $fillable = [
        'dosen_id',
        'user_id',
        'review_id',
        'file_proposal',
        'komentar',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
