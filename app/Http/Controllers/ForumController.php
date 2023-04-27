<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Notifications\ForumCommentNotice;
use App\Models\User;

class ForumController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new MyModel;
    }
    // public function forumIndex(Request $request)
    // {
    //     $search = $request->search;
    //     $forumNew2s = $this->model->forumNew2();

    //     $questions = $this->model->question();
    //     $Qoutputs = $this->model->forumQSearch($search);

    //     $groups = $this->model->group();
    //     $Goutputs = $this->model->forumGSearch($search);

    //     $haters = $this->model->hater();
    //     $Houtputs = $this->model->forumHSearch($search);

    //     $uid = Auth::id();
    //     $userPic = $this->model->UserPic($uid);
        
    //     return view('forum.forumQIndex',[
    //         'forumNew2s' => $forumNew2s,
    //         'questions' => $questions,
    //         'groups' => $groups,
    //         'haters' => $haters,
    //         'uid' => $uid,
    //         'Qoutputs' => $Qoutputs,
    //         'Goutputs' => $Goutputs,
    //         'Houtputs' => $Houtputs,
    //         'userPic' => $userPic
    //     ]);
    // }

    public function forumQIndex(Request $request)
    {
        $search = $request->search;
        $forumNew2s = $this->model->forumNew2();

        $questions = $this->model->question();
        $Qoutputs = $this->model->forumQSearch($search);

        $uid = Auth::id();
        $userPic = $this->model->UserPic($uid);
        
        return view('forum.forumQIndex',[
            'forumNew2s' => $forumNew2s,
            'questions' => $questions,
            'uid' => $uid,
            'Qoutputs' => $Qoutputs,
            'userPic' => $userPic,
            'search' => $search
        ]);
    }

    public function forumGIndex(Request $request)
    {
        $search = $request->search;
        $forumNew2s = $this->model->forumNew2();

        $groups = $this->model->group();
        $Goutputs = $this->model->forumGSearch($search);

        $uid = Auth::id();
        $userPic = $this->model->UserPic($uid);
        
        return view('forum.forumGIndex',[
            'forumNew2s' => $forumNew2s,
            'groups' => $groups,
            'uid' => $uid,
            'Goutputs' => $Goutputs,
            'userPic' => $userPic,
            'search' => $search
        ]);
    }

    public function forumHIndex(Request $request)
    {
        $search = $request->search;
        $forumNew2s = $this->model->forumNew2();

        $haters = $this->model->hater();
        $Houtputs = $this->model->forumHSearch($search);

        $uid = Auth::id();
        $userPic = $this->model->UserPic($uid);
        
        return view('forum.forumHIndex',[
            'forumNew2s' => $forumNew2s,
            'haters' => $haters,
            'uid' => $uid,
            'Houtputs' => $Houtputs,
            'userPic' => $userPic,
            'search' => $search
        ]);
    }
    public function forumDetail(Request $request)
    {
        $sfid = $request->sfid;
        $foid = $request->foid;
        $articles = $this->model->forumDetail($sfid,$foid);
        $FCquestions = $this->model->FCquestion($foid);
        $forumNews = $this->model->forumNew($sfid,$foid);
        $uid = Auth::id();
        $userPic = $this->model->UserPic($uid);
        $userDatas = $this->model->feelComPN($uid);
        $isRed = $this->model->FoIsRed($foid);
        return view('forum.forumDetail',[
            'articles' => $articles,
            'FCquestions' => $FCquestions,
            'forumNews' => $forumNews,
            'userDatas' => $userDatas,
            'sfid' => $sfid,
            'uid' => $uid,
            'foid'=> $foid,
            'userPic' => $userPic,
            'isRed' => $isRed
        ]);
    }

    public function forumCom(Request $request){
        $uid = Auth::id();
        $foid = $request->foid;
        $sfid = $request->sfid;
        $forumcom = $request->forumcom;
        // return [$uid,$foid,$sfid,$forumcom];
        $this->model->forumCom($uid,$sfid,$foid,$forumcom);

        $list = $this->model->forumDetail($sfid, $foid);
        $user = User::find($list[0]->uid); //要發送通知的對象poster
        $someone = Auth::user()->name;
        $title = $list[0]->title;
        $comment =  $request->forumcom;
        $user->notify(new ForumCommentNotice($someone, $title, $comment, $foid, $uid, $sfid));

        return redirect("/forumDetail/{$sfid}/{$foid}");
    }

    public function forumComEdit(Request $request){
        $forumcom = $request->content;
        $focid = $request->focid;
        $this->model->forumComEdit($focid,$forumcom);
        return redirect()->back();
    }

    public function forumComDelect(Request $request){
        $focid = $request->focid;
        $this->model->forumComDelect($focid);
        return redirect()->back();
    }


    public function forumMes(Request $request)
    {
        $uid = Auth::id();
        $title = $request->title;
        $content = $request->content;
        $sfid = $request->sfid;
        $state = $request->input('btValue');

        // 從請求中獲取文件實例
        // $file = $request->file('pic');
        // 獲取文件的二進制內容
        // $pic = $file->get();
        // $answer = $this->model->forumMes($sfid,$uid,$title,$content,$pic,$state);

        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $pic = $file->get();
            $mime_type = $file->getMimeType();
            $src = 'data:' . $mime_type . ';base64,' . base64_encode($pic);
        } else {
            $src = null;
        }
        $answer = $this->model->forumMes($sfid, $uid, $title, $content, $src, $state);
        if($answer === 0){
            // $request->session()->flash('answer', $answer);
            return redirect()->back()->with('answer', $answer);
        }else{
            return redirect("/forumQIndex")->with(['answer' => $answer]);
        }
    }

    public function forumSaved(Request $request)
    {
        $uid = Auth::id();
        $ftid = $request->ftid;
        $sfid = $request->sfid;
        $this->model->forumSaved($uid,$ftid);
        return redirect("/forumDetail/{$sfid}/{$ftid}");
        // return $sfid;

    }
    
    public function forumUnsaved(Request $request)
    {
        $uid = Auth::id();
        $ftid = $request->ftid;
        $sfid = $request->sfid;
        $this->model->forumUnsaved($uid,$ftid);
        return redirect("/forumDetail/{$sfid}/{$ftid}");
        // return $sfid;

    }



    public function getuserpic(){
        $uid = Auth::id();
        $myModel = new MyModel();
        $userPic = $myModel->UserPic($uid);
        return view('forum.forumMessage',[
            'uid' => $uid,
            'userPic' => $userPic
        ]);
    }
    
    

}