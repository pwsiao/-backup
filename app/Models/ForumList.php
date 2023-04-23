<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumList extends Model
{
    use HasFactory;

    protected $table = 'Forum_list';
    protected $primaryKey = 'foid';
    protected $keyType = 'integer';
    public $timestamps = false;

}
