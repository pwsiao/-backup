@extends('main')


@section('head')
<title>共乘資訊</title>
<link rel="stylesheet" href="{{ asset('css/cpinfo.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

@endsection


@section('content')
<div id="content-container">
    <div class="abc"></div>
    <div class="row">
        <div class="column1">
            <!-- 文章內容 -->
            <div id="content">
                <div>
                    @if(isset($cp->poster['upicture']))
                    <img src="{{$cp->poster['upicture']}}" alt="">
                    @else
                    <img src="{{asset('pic/admin.png')}}" alt="">
                    @endif
                    <div>{{$cp->poster['name']}}</div>
                </div>
                <div>
                    <h1>{{$cp->cptitle}}</h1>
                    <p>{{$cp->createtime}}</p>
                </div>
                <div id="artCon">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <h3>目的地 : <h3>
                                </td>
                                <td>{{$cp->arrive}}</td>
                            </tr>
                            <tr>
                                @if($cp->value == 1)
                                <td>我有車</td>
                                @elseif($cp->value == 2)
                                <td>找包車</td>
                                @endif
                            </tr>
                            <tr>
                                <td>
                                    <h3>出發日期 : </h3>
                                </td>
                                <td>{{$cp->departdate}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>回程日期 : </h3>
                                </td>
                                <td>{{$cp->returndate}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>出發地點 : </h3>
                                </td>
                                <td>{{$cp->depart}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>內建人數 : </h3>
                                </td>
                                <td>{{$cp->original}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>欲徵人數 : </h3>
                                </td>
                                <td>{{$cp->hire}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>包車費用 : </h3>
                                </td>
                                <td>{{$cp->cost}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="height: 50px;">
                                    <h3>備註 : </h3>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2" style="height: 50px;">{{$cp->note}}</td>
                            </tr>
                        </table>
                    </div>
                    <div style="height: 50px;"></div>
                </div>

            </div>

            <div id="content2">
                @if(strtotime($cp->departdate) > $today)
                    @if($joiner < $cp->hire)
                        @if(Auth::check())
                            @if($uid != $id)
                                @if($n1 == 0)
                                    <form method="post" action="{{route('cpjoin',['cpid'=>$cp->cpid])}}">
                                        @csrf
                                        <input type="submit" id="joinbutton1" value="加入">
                                    </form>
                                    @elseif($status == 0)
                                    <div id="joinbutton2">確認中</div>
                                    @elseif($status == 1)
                                    <div id="joinbutton2">已加入</div>
                                    @elseif($status == 2)
                                    <div id="joinbutton2">被拒絕</div>
                                @endif
                                @else
                                    <div style="height: 100px"></div>
                                @endif
                            @else
                            <a href="{{route('login')}}" id="joinbutton2">加入</a>
                        @endif
                    @elseif(Auth::check() && $status == 1)
                    <div id="joinbutton2">已加入</div>
                    @else
                    <div id="joinbutton2">已徵滿</div>
                    @endif    
                @else
                <div id="joinbutton2">已過期</div>
                @endif    
            </div>

            <div id="carpool-comment">
                @if( isset($comments))
                @foreach($comments as $comment)
                <div id="mesHis">
                    <div class="headDiv">
                        <div class="headDivChi">
                            @if(isset($comment->upicture))
                            <img class="headDivPic" src="{{$comment->upicture}}">
                            @else
                            <img class="headDivPic" src="{{asset('pic/admin.png')}}" >
                            @endif
                            <p>{{$comment->name}}</p>
                        </div>
                        <div class="headDivChi2">
                            <div>{{$comment->content}}</div>
                        </div>
                    </div>
                    <hr>
                </div>
                @endforeach
                @else
                <div id="mesHis">
                    <div class="headDiv">
                        <div class="headDivChi">
                        </div>
                        <div class="headDivChi2">
                            <p>還沒有人留言喔～</p>
                            <p>快來當頭香～</p>
                        </div>
                    </div>
                    <hr>
                </div>
                @endif




                <!-- 留言 -->
                <div id="mes">
                    @if (Auth::check())
                    <form method="post" action="{{route('cpcomment',['cpid'=> $cp->cpid])}}" id="myForm">
                        @csrf
                        @foreach($userDatas as $userData)
                        <div class="formPic">
                            @if(empty($userData->upicture) == false)
                            <img class="headDivPic" src="{{$userData->upicture}}">
                            @else
                            <img class="headDivPic" src="{{asset('pic/admin.png')}}" >
                            @endif
                            <p>{{$userData->name}} ></p>
                        </div>
                        @endforeach
                        <textarea name="cpcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                        <input id="submitBtn" type="submit" value="-送出-">
                    </form>
                    <script src="{{ asset('js/formtrim.js') }}"></script>
                    @else
                    <textarea name="feelcom" id="" cols="30" rows="10" placeholder="你需要先登入才能留言喔～" disabled></textarea>
                    <input type="button" value="-送出-">
                    @endif
                </div>
            </div>
        </div>
        <div class="column2">
            <aside>
                <h1>-最近揪共乘-</h1>
                @foreach($cplist as $cp)
                @if(strtotime($cp->departdate) > $today)
                <div class="article2">
                    <div class="article2Con">
                        <a href="{{route('cpinfo',[$cp->cpid])}}">
                            <h4>{{$cp->cptitle}}</h4>
                        </a>
                        <p>目的地：{{$cp->arrive}}</p>
                        <p>出發日期：{{$cp->departdate}}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </aside>
        </div>
    </div>
    <div class="abcc"></div>

    @endsection