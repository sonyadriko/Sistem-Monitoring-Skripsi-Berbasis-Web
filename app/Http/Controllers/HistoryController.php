<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function notifications(Request $request)
    {
        if ($request->ajax()) {
            $allActivityNotifBar = DB::table('histories')
                ->join('users', 'users.id', 'histories.created_by')
                ->where('histories.created_by', Auth::user()->id)
                ->select(
                    'histories.name_history',
                    'histories.content_history',
                    'histories.alert_history',
                    'histories.action_history',
                    'histories.created_at'
                )
                ->orderBy('histories.created_at', 'DESC')
                ->paginate(10);
            $notificationLists = '';
            foreach ($allActivityNotifBar as $key => $allActivityNotifBar) {
                $diffTime = Carbon::parse($allActivityNotifBar->created_at)->diffForHumans();
                $notificationLists .= '
                    <a class="dropdown-item d-flex align-items-center py-2" href="javascript:;">
                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                            <i class="icon-sm text-white" data-feather="gift"></i>
                        </div>
                        <div class="flex-grow-1 me-2">
                            <p>'.$allActivityNotifBar->content_history.'</p>
                            <p class="tx-12 text-muted">'.$diffTime.'</p>
                        </div>
                    </a>
                ';
            }
            $data = [
                'notifications' => $notificationLists,
                'code' => 1,
            ];

            return json_encode($data);
        } else {
            return redirect()->back()->with('danger', 'Akses tidak diijinkan!');
        }
    }
}
