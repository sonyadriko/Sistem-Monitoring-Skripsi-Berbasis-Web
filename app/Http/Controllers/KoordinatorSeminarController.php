<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeminarProposal as SeminarProposal;
use Illuminate\Support\Facades\DB;

class KoordinatorSeminarController extends Controller
{
    public function index()
    {
        // $sempros = SeminarProposal::all();
        $sempros = DB::table('seminar_proposal')->join('users', 'users.id', 'seminar_proposal.user_id')->get();
     
        return view('koordinator/penjadwalan/seminar_proposal.index', compact('sempros'));

    }

    // public function detail($id)
    // {
    //     $data = [
    //         'data' => DB::table('seminar_proposal')->where('id_seminar_proposal', '=', $id)->first(),
            
    //     ];


    //     if ($data['data']) {
    //         return view('koordinator/penjadwalan/seminar_proposal.detail', $data);
    //     } else {
    //         // Handle the case when no record was found
    //         return redirect()->back()->with('error', 'Record not found.');
    //     }
    // }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('seminar_proposal')->where('id_seminar_proposal', '=', $id)->first(),
        ];

        if ($data['data']) {
            $userId = $data['data']->user_id;
            $temaId = $data['data']->tema_id;

            $users = DB::table('users')->where('id', '=', $userId)->first();
            $tema = DB::table('tema')->where('id_tema', '=', $temaId)->first();

            if ($users) {
                $data['users'] = $users;
                $data['tema'] = $tema;

                return view('koordinator/penjadwalan/seminar_proposal.detail', $data);
            } else {
                // Handle the case when no user record was found
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            // Handle the case when no seminar proposal record was found
            return redirect()->back()->with('error', 'Seminar proposal record not found.');
        }
    }


   

}
