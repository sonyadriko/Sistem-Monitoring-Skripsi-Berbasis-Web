<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiSeminarProposal extends Model
{
    protected $table = 'revisi_seminar_proposal';

    protected $fillable = [
        'seminar_proposal_id',
        'file_revisi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_revisi_seminar_proposal';
}
