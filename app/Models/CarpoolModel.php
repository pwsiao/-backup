<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CarpoolModel extends Model
{
    use HasFactory;
    
    public function countjoiner($cpid){
        $a = DB::select('select count(*) from carpool_join where cpid = ? and status = 1',[$cpid]);
        $a1 = $a[0]->{'count(*)'} ;
        $b = DB::table('carpool_list1')->where('cpid',$cpid)->value('hire');
        $remain = $b - $a1 ;
        return $remain;
        
    }
    
}
