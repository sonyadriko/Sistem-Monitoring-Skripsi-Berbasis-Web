<?php


namespace App\Http\Controllers;

// use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    //
    public function index()
    {
        $mahasiswaCount = DB::table('users')->where('role_id', '1')->count();
        $dosenCount = DB::table('users')->where('role_id', '2')->count();


        return view('koordinator.index', compact('mahasiswaCount', 'dosenCount'));
    }
}
