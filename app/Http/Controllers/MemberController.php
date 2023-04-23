<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CpList;
use App\Models\ForumList;
use App\Models\FeelList;
use App\Models\FeelSaved;
use App\Models\ForumSaved;


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

    // 論壇
    public function getForumList() {
        $uid = Auth::id();
        $forumList = ForumList::select('*', DB::raw('Date(createtime) as date'))
                   ->where('uid', $uid)
                   ->orderby('date', 'desc')
                   ->get();

        $forumComments = ForumList::leftJoin('Forum_comment', 'Forum_list.foid', '=', 'Forum_comment.foid')
                    ->select('Forum_list.*', 'Forum_comment.content as forumComment', DB::raw('Date(Forum_comment.createtime) as date'))
                    ->whereNotNull('Forum_comment.foid')
                    ->where('Forum_comment.uid', $uid)
                    ->orderby('date', 'desc')
                    ->get();

        // dd($forumComments);
        return view('member.forum', ['forumList'=> $forumList, 'forumComments'=>$forumComments]);
    }

    public function editForum(Request $request) {
        $forum = ForumList::find($request->foid);
        // dd($forum);
        return view('member.editForum', [
            'forum' => $forum,
            'fpicture' => $forum->fpicture,
            'sfid' => $forum->sfid,
            'title' => $forum->title,
            'content' => $forum->content
        ]);
    }

    public function editForumDone(Request $request) {
        $foid = $request->foid;
        $sfid = $request->sfid;
        $title = $request->title;
        $content = $request->content;

        $src = null;
        if (isset($request->pic)) {
            $data = $request->pic->get();
            $mime_type = $request->pic->getMimeType();
            $imageData = base64_encode($data);
            $src = "data:{$mime_type};base64,{$imageData}";
        }

        if ($src == null) {
            ForumList::where('foid', $foid)->update([
                'sfid' => $sfid,
                'title' => $title,
                'content' => $content
            ]);    
        } else {
            ForumList::where('foid', $foid)->update([
                'fpicture' => $src,
                'sfid' => $sfid,
                'title' => $title,
                'content' => $content
            ]);    
        }
        // dd($request);

        return redirect("/forumDetail/{$sfid}/{$foid}");
    }

    public function delForum($foid) {
        $delForum = ForumList::find($foid);
        $delForum->delete();

        return redirect("/member/forum");
    }

    // 心得
    public function getFeelList() {
        $uid = Auth::id();
        $feelList = FeelList::select('*', DB::raw('Date(createtime) as date'))
                ->where('uid', $uid)
                ->orderby('date', 'desc')
                ->get();

        $feelComments = FeelList::leftJoin('Feel_comment', 'Feel_list.fid', '=', 'Feel_comment.fid')
                ->select('Feel_list.*', 'Feel_comment.content as feelComment', DB::raw('Date(Feel_comment.createtime) as date'))
                ->whereNotNull('Feel_comment.fid')
                ->where('Feel_comment.uid', $uid)
                ->orderby('date', 'desc')
                ->get();

    return view('member.feel', ['feelList' => $feelList, 'feelComments' => $feelComments]);    
    }

    public function editFeel(Request $request) {
        $feel = FeelList::find($request->fid);
        return view('member.editFeel', [
            'feel' => $feel,
            'fpicture' => $feel->fpicture,
            'title' => $feel->title,
            'content' => $feel->content
        ]);
    }

    public function editFeelDone(Request $request) {
        $fid = $request->fid;
        $title = $request->title;
        $content = $request->content;

        $src = null;
        if (isset($request->pic)) {
            $data = $request->pic->get();
            $mime_type = $request->pic->getMimeType();
            $imageData = base64_encode($data);
            $src = "data:{$mime_type};base64,{$imageData}";
        }

        if ($src == null) {
            FeelList::where('fid', $fid)->update([
                'title' => $title,
                'content' => $content
            ]);    
        } else {
            FeelList::where('fid', $fid)->update([
                'fpicture' => $src,
                'title' => $title,
                'content' => $content
            ]);    
        }
        // dd($request);

        return redirect("/feelDetail/{$fid}");
    }

    public function delFeel($fid) {
        $delFeel = FeelList::find($fid);
        $delFeel->delete();

        return redirect("/member/feel");
    }


    // 收藏
    public function getSaveList() {
        $uid = Auth::id();

        $feelSaveList = FeelSaved::leftJoin('Feel_list', 'Feel_list.fid', '=', 'Feel_saved.fid')
                ->select('*', DB::raw('Date(createtime) as date'))
                ->whereNotNull('Feel_list.fid')
                ->where('Feel_saved.uid', $uid)
                ->get();

        $forumSaveList = ForumSaved::leftJoin('Forum_list', 'Forum_list.foid', '=', 'Forum_saved.foid')
                ->select('*', DB::raw('Date(createtime) as date'))
                ->whereNotNull('Forum_list.foid')
                ->where('Forum_saved.uid', $uid)
                ->get();


    return view('member.save', ['feelSaveList' => $feelSaveList,'forumSaveList' => $forumSaveList]);
    }

    public function goToForum(Request $request) {
        $forumSaved = ForumList::leftJoin('Forum_saved', 'Forum_list.foid', '=', 'Forum_saved.foid')
                ->select("*")
                ->where('Forum_list.foid', $request->foid)
                ->first();
        // dd($forumSaved);
        
    return redirect("/forumDetail/{$forumSaved->sfid}/{$forumSaved->foid}");
    }
}
