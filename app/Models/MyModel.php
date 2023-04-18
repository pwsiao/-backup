<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console; 


class MyModel extends Model
{
    use HasFactory;


    // 心得
    // function feelIndex(){
    //     $datas = DB::select("select * from Feel_list left join users on Feel_list.uid = users.id order by Feel_list.createtime");
    //     return $datas;
    // }
    function feelIndex(){
        $datas = DB::table('Feel_list')
                ->leftJoin('users', 'Feel_list.uid', '=', 'users.id')
                ->where('state','=','1')
                ->orderByDesc('Feel_list.createtime')
                ->paginate(10);
        return $datas;
    }
    function feelnew($ftid){
        $datas = DB::table('Feel_list')
                ->leftJoin('users', 'Feel_list.uid', '=', 'users.id')
                ->where('state','=','1')
                ->where('fid','<>',$ftid)
                ->orderByDesc('Feel_list.createtime')
                ->paginate(10);
        return $datas;
    }

    function UserPic($uid){
        $userPic = DB::select("SELECT * FROM users WHERE id = ?",[$uid]);
        return $userPic;
    }

    function feelSearch($search){
        $outputs = DB::table('Feel_list')
        ->leftJoin('users', 'Feel_list.uid', '=', 'users.id')
        ->where('title', 'REGEXP', $search)
        ->where('state','=','1')
        ->orderByDesc('Feel_list.createtime')
        ->paginate(10);
        // $outputs = DB::select("SELECT * FROM `Feel_list` left join users on Feel_list.uid = users.id WHERE title REGEXP ?",[$search]);
        return $outputs;
    }

    
    function feelNews(){
        $datas = DB::select("select * from Feel_list left join users on Feel_list.uid = users.id order by Feel_list.createtime LIMIT 10");
        return $datas;
    }
    function feelDetail($id){
        $datas = DB::select("select * from Feel_list left join users on Feel_list.uid = users.id where Feel_list.fid = ?",[$id]);
        return $datas;
    }
    function feelComment($id){
        $comments = DB::select("select Feel_comment.content as content,upicture,name,title,Feel_comment.createtime from Feel_comment left join Feel_list on Feel_comment.fid = Feel_list.fid left join users on Feel_comment.uid = users.id where Feel_comment.fid = ?",[$id]);
        return $comments;
    }

    function feelComPN($uid){
        $userDatas = DB::select("select name, upicture from users where id = ?",[$uid]);
        return $userDatas;
    }

    function feelCom($ftid,$uid,$feelcom){
        DB::insert("INSERT INTO `Feel_comment` SET fid = ?, uid = ?, content = ? ",[$ftid,$uid,$feelcom]);
        $answer = "ok";
        return $answer;
    }

    function feelMes($uid,$title,$content,$pic,$state){
        DB::insert("INSERT INTO Feel_list SET uid = ?, title = ?, content = ?,fpicture = ? ,state = ?",[$uid, $title, $content,$pic,$state]);
        $answer = "ok";
        return $answer;
    }

    function feelSaved($uid,$ftid){
        DB::insert("INSERT INTO `Feel_Saved` SET uid = ?, fid = ?",[$uid,$ftid]);
        $answer = "ok";
        return $answer;
    }

    function feelUnsaved($uid,$ftid){
        DB::delete("Delete from `Feel_Saved` WHERE uid = ? and fid = ?",[$uid,$ftid]);
        $answer = "ok";
        return $answer;
    }

    // function feelMesSaved($uid,$title,$content,$pic){
    //     DB::insert("INSERT INTO FeelMes_saved SET uid = ?, title = ?, content = ?,fpicture = ? ",[$uid, $title, $content,$pic]);
    //     $answer = "ok";
    //     return $answer;
    // }

    
    // 論壇

    // function question(){
    //     $questions = DB::select("select fpicture,foid,title,name,Forum_list.createtime as createtime from Forum_list left join users on Forum_list.uid = users.id where Forum_list.sfid = 1 order by Forum_list.createtime");
    //     return $questions;
    // }
    function question(){
        $questions = DB::table('Forum_list')
                ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
                ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
                ->where('Forum_list.sfid', '=', 1)
                ->where('state','=','1')
                ->orderByDesc('Forum_list.createtime')
                ->paginate(10);

        return $questions;
    }

    function forumQSearch($search){
        $Qoutputs  = DB::table('Forum_list')
        ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
        ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
        ->where('Forum_list.sfid', '=', 1)
        ->where('state','=','1')
        ->where('title', 'REGEXP', $search)
        ->orderByDesc('Forum_list.createtime')
        ->paginate(10);
        return $Qoutputs;
    }

    // function group(){
    //     $groups = DB::select("select fpicture,foid,title,name,Forum_list.createtime as createtime from Forum_list left join users on Forum_list.uid = users.id where Forum_list.sfid = 2 order by Forum_list.createtime");
    //     return $groups;
    // }
    function group(){
        $groups= DB::table('Forum_list')
        ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
        ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
        ->where('Forum_list.sfid', '=', 2)
        ->where('state','=','1')
        ->orderByDesc('Forum_list.createtime')
        ->paginate(10);
        return $groups;
    }

    function forumGSearch($search){
        $Goutputs  = DB::table('Forum_list')
        ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
        ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
        ->where('Forum_list.sfid', '=', 2)
        ->where('state','=','1')
        ->where('title', 'REGEXP', $search)
        ->orderByDesc('Forum_list.createtime')
        ->paginate(10);
        return $Goutputs;
    }

    // function hater(){
    //     $haters = DB::select("select fpicture,foid,title,name,Forum_list.createtime as createtime from Forum_list left join users on Forum_list.uid = users.id where Forum_list.sfid = 3 order by Forum_list.createtime");
    //     return $haters;
    // }
    function hater(){
        $haters= DB::table('Forum_list')
        ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
        ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
        ->where('Forum_list.sfid', '=', 3)
        ->where('state','=','1')
        ->orderByDesc('Forum_list.createtime')
        ->paginate(10);
        return $haters;
    }

    function forumHSearch($search){
        $Houtputs  = DB::table('Forum_list')
        ->leftJoin('users', 'Forum_list.uid', '=', 'users.id')
        ->select('fpicture', 'foid', 'title', 'name', 'Forum_list.createtime as createtime')
        ->where('Forum_list.sfid', '=', 3)
        ->where('title', 'REGEXP', $search)
        ->where('state','=','1')
        ->orderByDesc('Forum_list.createtime')
        ->paginate(10);
        return $Houtputs;
    }

    function forumDetail($sid,$foid){
        $datas = DB::select("select fpicture,name,title,Forum_list.createtime,upicture,Forum_list.content as content from Forum_list left join users on Forum_list.uid = users.id where Forum_list.sfid = ? and Forum_list.foid = ? ",[$sid, $foid]);
        return $datas;
    }

    function FCquestion($foid){
        $FCquestions = DB::select("SELECT * FROM Forum_comment left join users on Forum_comment.uid = users.id where foid = ?",[$foid]);
        return $FCquestions;
    }

    function forumNew($sid,$foid){
        $forumNews = DB::select("select * from Forum_list left join users on Forum_list.uid = users.id where Forum_list.sfid = ? and state = 1 and Forum_list.foid <> ? order by Forum_list.createtime DESC",[$sid,$foid]);
        return $forumNews;
    }

    function forumNew2(){
        // $forumNew2s = DB::select("select foid,title,name from Forum_list left join users on Forum_list.uid = users.id order by Forum_list.createtime");
        $forumNew2s = DB::select("select * from Forum_list left join users on Forum_list.uid = users.id where state = 1 order by Forum_list.createtime DESC LIMIT 14");
        return $forumNew2s;
    }
    
    function forumCom($uid,$sfid,$foid,$forumcom){
        DB::insert("INSERT INTO `Forum_comment` SET uid = ?, sfid = ?, foid = ?, content = ?",[$uid,$sfid,$foid,$forumcom]);
        $answer = "ok";
        return $answer;
    }

    function forumSaved($uid,$ftid){
        DB::insert("INSERT INTO `Forum_Saved` SET uid = ?, foid = ?",[$uid,$ftid]);
        $answer = "ok";
        return $answer;
    }
    
    function forumUnsaved($uid,$ftid){
        DB::delete("Delete from `Forum_Saved` WHERE uid = ? and foid = ?",[$uid,$ftid]);
        $answer = "ok";
        return $answer;
    }
    


    function forumMes($sfid,$uid,$title,$content,$pic,$state){
        DB::insert("INSERT INTO Forum_list SET sfid = ?, uid = ?, title = ?, content = ?, fpicture = ?, state = ?",[$sfid, $uid, $title, $content, $pic, $state]);
        $answer = "ok";

        return $answer;     
    }

    // function forumMesSaved($sfid,$uid,$title,$content,$pic){
    //     DB::insert("INSERT INTO forumMes_saved SET sfid = ?, uid = ?, title = ?, content = ?, fpicture = ?",[$sfid, $uid, $title, $content, $pic]);
    //     $answer = "ok";
    //     return $answer;     
    // }
    


    
}
