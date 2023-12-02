<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSurveyPerusahaan extends Model
{
    protected $table = 'surat_survey';

    protected $fillable = [
        'users_id',
        'bimbingan_proposal_id',
        'nama_instansi',
        'nama_penerima',
        'alamat_instansi',
        'durasi',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id_surat_survey';
}
