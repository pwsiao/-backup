<?php

namespace App\Http\Controllers;

use App\Models\CpList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\RedirectResponse;
use App\Mail\JoinNotice;
use App\Models\CarpoolModel;
use Illuminate\Support\Facades\Mail;


class CarpoolController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new CarpoolModel();

    }

    public function gettoday(){
        $min = date('Y-m-d',strtotime("+1 day"));
        $max = date('Y-m-d',strtotime("+1 year"));
        // dd($min);
        return view('/carpool/cpform',[
            'min'=>$min,
            'max'=>$max,
        ]);
    }


    //發起共乘 cpform
    public function create(Request $req){
        $id = Auth::id();
        $cp = new CpList();
        // $cp->uid = $req->user();
        $cp->uid = $id;
        $cp->cptitle = $req -> title1;
        $cp->value = $req -> radio1;
        $cp->arrive = $req -> arrive1;
        $cp->departdate = $req -> departdate1;
        $cp->returndate = $req -> returndate1;
        $cp->depart = $req -> depart1;
        $cp->original = $req -> original1;
        $cp->hire = $req -> hire1;
        $cp->cost = $req -> cost1;
        $cp->note = $req -> note1;
        // $cp->createtime = $req -> timestamps;
        $cp->save();
        return Redirect::to("/carpool/info/{$cp->cpid}");
    }

    //共乘資訊 cpinfo
    public function showinfo($cpid){

        //側邊欄
        $cplist = Cplist::orderBy('createtime')->limit(5)->get();

        //共乘內文
        $cp = CpList::find($cpid);
        //poster連結發文者 名字照片
        // dd($cp->poster); 

        //登入者 
        $id = Auth::id();

        // 發文者id 判斷參加鈕是否顯示用
        $uid = DB::table('carpool_list1')->where('cpid',$cpid)
                                         ->value('uid');

        //留言板內容
        $comments = DB::table('carpool_comment')
                        ->leftJoin('users','carpool_comment.uid','=','users.id' )
                        ->where('cpid', $cpid)->get();
        // dd($comments);

        //判斷登入者是否有參加了
        $n = DB::select("select count(*) from carpool_join where cpid = ? and uid = ?",[$cpid, $id]);
        $n1 = $n[0]->{'count(*)'} ;

        //參加狀態
        $status = DB::table('carpool_join')->where('cpid',$cpid)
                                           ->where('uid',$id)
                                           ->value('status'); 

        return view('carpool.cpinfo',[
            'title'=> $cp->cptitle,
            'value'=> $cp->value,
            'arrive'=>$cp->arrive,
            'departdate'=>$cp->departdate,
            'returndate'=>$cp->returndate,
            'depart'=>$cp->depart,
            'original'=>$cp->original,
            'hire'=>$cp->hire,
            'cost'=>$cp->cost,
            'createtime'=>$cp->createtime,
            'note'=>$cp->note,
            'postername'=>$cp->poster['name'],
            'posterpicture'=>$cp->poster['upicture'],
            'n1'=> $n1,
            'status'=>$status,
            'uid'=>$uid,
            'id'=>$id,
            'comments'=>$comments,
            'cpid'=>$cp->cpid,
            'cplist'=>$cplist,
        ]);
    }
    // $status = DB::select('select status from carpool_join where cpid = ? and uid = ?',[$cpid,$id]);
    // var_dump($status);
    // array(1) { [0]=> object(stdClass)#337 (1) { ["status"]=> int(0) } }
    




    // 共乘首頁列表
    public function cplist(){
        $cplist = CpList::orderBy('createtime','desc')->get();
        // dd($cplist[0]->cptitle);

        // $cplist = DB::select("select count(*) from carpool_list1")
        //             ->leftJoin("carpool_join","carpool_list1","=","carpool_join");



  

        return view('carpool.cphome', ['cplist'=>$cplist]);
    }


    
    //按下參加，發送email
    public function join($cpid) : RedirectResponse{

        $id = Auth::id();
        DB::insert('insert into carpool_join set cpid = ?, uid = ?, status = ?',[$cpid, $id, 0]);

        $creatoremail = DB::table('carpool_list1')
                      ->leftJoin('users', 'carpool_list1.uid', '=', 'users.id')
                      ->where('cpid',$cpid)
                      ->value('email');


        $join = CpList::findOrFail($cpid);
        Mail::to($creatoremail)->send(new JoinNotice($join));
        // dd($creatoremail);
        return redirect("/carpool/info/{$cpid}");
    }



    //留言
    public function comment(Request $req, $cpid) {
        $uid = Auth::id();
        $content = $req->cpcom;
        DB::insert("insert into carpool_comment set uid = ?, cpid = ?, content = ?",[$uid, $cpid, $content]);
        return redirect("/carpool/info/{$cpid}");
    }


    public function test(Request $req){
        $u = new User();
        if(isset($req->upicture)){
        $upicture = $req->file('upicture');
        $u->upicture = $upicture;
        $u->save();
        // DB::update('update users set upicture = ? where id = 1 ',[$upicture]);
        return "ok";
    }
    }




}
