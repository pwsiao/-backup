<?php

namespace App\Http\Controllers;
use App\Models\MyModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new MyModel;
    }
    public function Index()
    {   
        $feeldatas = $this->model->feelNews();
        $forumdatas = $this->model->forumNew2();

        if(Auth::check()){
            $user = Auth::user();
            $notice = $user->notifications;
            // dd($notice);
            $notice->markAsRead();
        }else{
            $notice="";
        }

        return view('Index',[
            'feeldatas'=>$feeldatas,
            'forumdatas'=>$forumdatas,
            'notice'=>$notice,
        ]);
        // return $datas;
    }

    public function getweather(){
        $url = "https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-B0053-035?Authorization=CWB-CDD469FA-E313-4813-9F19-D8C73607E43E&downloadType=WEB&format=JSON";
        $weatherraw = file_get_contents($url);
        // $weather = json_encode($weatherraw);
        $weather = json_decode($weatherraw, true);
        // dd($weather);

        return $weather;
    }

}
