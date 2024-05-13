<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraProposal extends Model
{
    protected $table = 'berita_acara_proposal';
    protected $primaryKey = 'id_berita_acara_p';
    protected $fillable = ['users_id', 'seminar_proposal_id', 'updated_at', 'created_at'];


}
