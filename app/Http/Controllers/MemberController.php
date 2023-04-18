<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CpList;


class MemberController extends Controller
{

    public function getcpinfo()
    {
        $uid = Auth::id();
        $cp = DB::table('carpool_list1')->where('uid', $uid)->get();
        // dd($cp);

        $joiner = DB::table('carpool_list1')
                    ->leftJoin('carpool_join', 'carpool_list1.cpid', '=', 'carpool_join.cpid')
                    ->leftJoin('users', 'carpool_join.uid', '=', 'users.id')
                    ->where('carpool_list1.uid',$uid)
                    ->get();
        // dd($joiner);
        // $joiner = DB::table('carpool_join')
        //             ->leftJoin('users', 'carpool_join.uid', '=', 'users.id')
        //             ->leftJoin('carpool_list1', 'carpool_join.cpid', '=', 'carpool_list1.cpid')
        //             ->where('carpool_list1.uid',$uid)
        //             ->get();
                

        return view('member.carpool', ['cp'=> $cp, 'joiner' => $joiner]);
    }

   
    public function comfirmjoin(Request $req)
    {
        $value = $req->input('cpconfirm');
        $joiner = $req->input('joiner');
        $cpid = $req->input('cpid');
        DB::update('update carpool_join set status = ? where uid = ? and cpid = ?',[$value, $joiner, $cpid]);

        return redirect('/member/carpool');
    }
}
