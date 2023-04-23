<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelList extends Model
{
    use HasFactory;

    protected $table = 'Feel_list';
    protected $primaryKey = 'fid';
    protected $keyType = 'integer';
    public $timestamps = false;
}
