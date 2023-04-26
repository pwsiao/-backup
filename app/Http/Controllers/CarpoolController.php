<?php

namespace App\Http\Controllers;

// use App\Notifications\InvoicePaid;
// use App\Models\Invoice;
use App\Models\CpList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\RedirectResponse;
use App\Mail\JoinNotice;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Mail;
use App\Notifications\WannajoinNotice;
use App\Notifications\CpcommentNotice;
use App\Notifications\ConfirmJoinNotice;
use App\Notifications\DeclineJoinNotice;
use Illuminate\Support\Facades\Notification;


class CarpoolController extends Controller
{

    //表單限制日期 /cpform
    public function getdate(){
        $min = date('Y-m-d',strtotime("+1 day"));
        $max = date('Y-m-d',strtotime("+1 year"));
        // dd($min);
        return view('/carpool/cpform',[
            'min'=>$min,
            'max'=>$max,
        ]);
    }


    //發起共乘 /cpform
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


    //共乘資訊 /cpinfo
    public function showinfo($cpid){
        $today = strtotime("now");

        //側邊欄
        $cplist = DB::select('select * from carpool_list1 where departdate > now() order by departdate limit 6');

        //共乘內文
        $cp = CpList::find($cpid);
        //poster連結發文者 名字照片
        // dd($cp->poster); 

        //登入者 
        $id = Auth::id();
        $userDatas = DB::table('users')->where('id',$id)->get();

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

        //幾人已參加
        $n2 = DB::select("select count(*) from carpool_join where cpid = ? and status = 1",[$cpid]);
        $joiner = $n2[0]->{'count(*)'} ;


        //參加狀態
        $status = DB::table('carpool_join')->where('cpid',$cpid)
                                           ->where('uid',$id)
                                           ->value('status'); 

            return view('carpool.cpinfo',[
                'cp'=>$cp,
                'n1'=> $n1,
                'joiner'=> $joiner,
                'status'=>$status,
                'uid'=>$uid,
                'id'=>$id,
                'userDatas'=>$userDatas,
                'comments'=>$comments,
                'cplist'=>$cplist,
                'today'=>$today,

        ]);
    }


    // 共乘首頁列表 /cphome
    public function cplist(Request $req){
       
        // $cplist = CpList::orderBy('createtime','desc')->get();
        // dd($cplist[0]->cptitle);

        $cplist = DB::select("select  * FROM carpool_list1 left join
                                ( select cpid, count(*) as joiner  from carpool_join 
                                where status=1 group by cpid ) as a 
                                on carpool_list1.cpid = a.cpid");

        
        // $countjoiner = DB::table('carpool_join')
        //         ->select('cpid', DB::raw('count(*) as joiner'))
        //         ->groupBy('cpid');

        $searchresult = DB::table('carpool_list1')
                ->leftJoin('users','carpool_list1.uid','=','users.id')
                ->where('cptitle', 'REGEXP', $req->search)
                ->get();  
                
        // dd($searchresult);        
        // $search = $req->search;                      

        // dd($cplist2);

        return view('carpool.cphome', [
            'cplist'=>$cplist, 
            // 'cplist2'=> $cplist2,
            'searchresult'=>$searchresult,
            'search'=> $req->search,
        ]);
    }

   
    //按下參加，發送email /cpinfo
    public function join($cpid) : RedirectResponse{

        $id = Auth::id();
        DB::insert('insert into carpool_join set cpid = ?, uid = ?, status = ?',[$cpid, $id, 0]);

        $poster = CpList::find($cpid);
        // dd($poster->poster['id']);
        
        Mail::to($poster->poster['email'])->send(new JoinNotice());

        $user = User::find($poster->poster['id']);
        $joiner = Auth::user()->name;
        $cptitle = $poster->cptitle;
        $user->notify(new WannajoinNotice($joiner, $cptitle));
        
        return redirect("/carpool/info/{$cpid}");
    }


    //留言 /cpinfo
    public function comment(Request $req, $cpid) {
        $uid = Auth::id();
        $content = $req->cpcom;
        DB::insert("insert into carpool_comment set uid = ?, cpid = ?, content = ?",[$uid, $cpid, $content]);
        
        $cplist = CpList::find($cpid);
        $user = User::find($cplist->poster['id']); //要發送通知的對象poster
        $someone = Auth::user()->name;
        $cptitle = $cplist-> cptitle;
        $comment =  $req->cpcom;
        $user->notify(new CpcommentNotice($someone, $cptitle, $comment, $cpid, $uid));

        return redirect("/carpool/info/{$cpid}");
    }


    //編輯頁面 /member
    public function edit(Request $req){
        $cp = CpList::find($req->cpid);
        // dd($req->cpid);
        $min = date('Y-m-d',strtotime("+1 day"));
        $max = date('Y-m-d',strtotime("+1 year"));
        // dd($min);


        return view('carpool.cpedit', [
            'min'=>$min,
            'max'=>$max,
            'cp'=> $cp,
        ]);
    }


    //更新 /member
    public function update(Request $req){
        $cp = CpList::find($req->cpid);
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
        $cp->save();
        return Redirect::to("/carpool/info/{$cp->cpid}");

    }


    //刪除 /member
    public function delete(Request $req){
        CpList::where('cpid', $req->cpid)->delete();
        return redirect(route('mbcp'));
    }
    

    //會員頁cp /member
    public function getcpinfo()
    {

        // dd($today);
        $uid = Auth::id();

        //開團中
        $cp = DB::select('select carpool_list1.cpid, departdate, cptitle, hire, number, createtime from carpool_list1 left join 
                            ( select cpid, count(*) as number from carpool_join where status=1 GROUP by cpid ) as a
                            on carpool_list1.cpid = a.cpid where departdate > now() and uid = ? order by departdate ',[$uid]);
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
                
       
        //參加中
        $cp2 = DB::select('select * from carpool_join left join carpool_list1 
                            on carpool_join.cpid = carpool_list1.cpid where carpool_join.status = 1
                            and carpool_join.uid = ? and carpool_list1.departdate > now()',[$uid]);

        $joiner2 = DB::table('carpool_join')
                        ->leftJoin('users', 'carpool_join.uid', '=', 'users.id')->get();

        //確認中
        $cp3 = DB::select('select * from carpool_join left join carpool_list1 
                            on carpool_join.cpid = carpool_list1.cpid where carpool_join.status = 0
                            and carpool_join.uid = ? and carpool_list1.departdate > now()',[$uid]); 
                          
                                                
        //歷史紀錄
        $cp4 = DB::select('select carpool_join.cpid, carpool_join.uid, status, cptitle, departdate from carpool_join 
                            left join carpool_list1 on carpool_join.cpid = carpool_list1.cpid where status = 1 
                            and carpool_join.uid = ? and departdate < now() 
                            union all
                            select cpid, uid, 4, cptitle, departdate from carpool_list1 where uid = ? and departdate < now() 
                            order by departdate desc',[$uid, $uid]); 
        
        // dd(json_decode($cp2));
        // dd($joiner2);
        return view('member.carpool', [
            'cp'=> $cp,
            'joiner' => $joiner,
            'cp2'=>$cp2,
            'joiner2'=>$joiner2,
            'cp3'=>$cp3,
            'cp4'=>$cp4,
        ]);
    }

   
    //會員頁確認鍵 /member
    public function comfirmjoin(Request $req)
    {
        $value = $req->input('cpconfirm');
        $joiner = $req->input('joiner');
        $cpid = $req->input('cpid');
        DB::update('update carpool_join set status = ? where uid = ? and cpid = ?',[$value, $joiner, $cpid]);

        $user = User::find($joiner);
        $poster = Auth::user()->name;
        $cptitle = CpList::find($cpid)->cptitle;
        if($value == 1){
            $user->notify(new ConfirmJoinNotice($poster, $cptitle));
        }else{
            $user->notify(new DeclineJoinNotice($poster, $cptitle));
        }

        return redirect('/member/carpool');
    }


    //確認中可以取消參加 /member
    public function cancel(Request $req){
        $uid = Auth::id();
        DB::delete('delete from carpool_join where uid = ? and cpid = ?',[$uid, $req->cpid]);
        return redirect(route('mbcp'));
    }


    //通知
    public function cpjoinNotice(){
        $user = Auth::user();
        $notice = $user->notifications;
        // dd($notice);
        $notice->markAsRead();
        return view('notice',['notice'=>$notice]);
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
