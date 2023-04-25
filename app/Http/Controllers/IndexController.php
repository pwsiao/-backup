<?php

namespace App\Http\Controllers;
use App\Models\MyModel;
use Illuminate\Support\Facades\DB;

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
        
        return view('Index',[
            'feeldatas'=>$feeldatas,
            'forumdatas'=>$forumdatas
        ]);
        // return $datas;
    }
}
