<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBimbinganProposal extends Model
{
    protected $table = 'detail_bimbingan_proposal';

    protected $fillable = [
        // 'user_id',
        'bimbingan_proposal_id',
        'file',
        'revisi',
        'validasi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_bimbingan_proposal';
}
