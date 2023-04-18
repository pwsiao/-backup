<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CpList;
use Illuminate\Http\RedirectResponse;
use App\Mail\JoinNotice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SendJoinNoticeMailController extends Controller
{
    public function store(Request $request) : RedirectResponse{

        $join = CpList::findOrFail(2);
        // $user = CpList::find(1);

        Mail::to('ch810538@gmail.com')->send(new JoinNotice($join));
        // dd($join);
        return redirect('/');
    }



}
