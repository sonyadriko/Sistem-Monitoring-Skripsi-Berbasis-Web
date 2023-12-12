<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRevisiSeminarProposal extends Model
{
    protected $table = 'detail_revisi_seminar_proposal';

    protected $fillable = [
        // 'users_id',
        'revisi_seminar_proposal_id',
        'file_revisi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_detail_revisi_seminar';
}
