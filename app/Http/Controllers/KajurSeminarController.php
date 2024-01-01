<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeminarProposal as SeminarProposal;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;
use Illuminate\Support\Facades\DB;

class KajurSeminarController extends Controller
{
    public function index()
    {
        $sempros = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->whereIn('status', ['pending', 'terima'])
            ->latest('seminar_proposal.created_at')
            ->get();

        return view('koordinator/penjadwalan/seminar_proposal.index', compact('sempros'));
    }
}
