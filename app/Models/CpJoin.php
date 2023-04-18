<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\CpList;
use Illuminate\Http\RedirectResponse;
use App\Mail\JoinNotice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CpJoin extends Model
{
    use HasFactory;

}
