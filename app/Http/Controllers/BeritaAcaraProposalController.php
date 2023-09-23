<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BeritaAcaraProposalController extends Controller
{
    //
    public function index()
    {
        return view('dosen/berita_acara/seminar.index');

    }
}
