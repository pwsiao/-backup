<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class CpList extends Model
{
    use HasFactory;

    protected $table = 'carpool_list1';
    protected $primaryKey = 'cpid';
    protected $keyType = 'integer';
    public $timestamps = false;

    function poster(){
        return $this->belongsTo(User::class, 'uid');
    }
    
}
