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
                @foreach($userDatas as $u)
                <div>
                    <img src="data:image/jpeg;base64,{{base64_encode( $u->upicture)}}">
                    <div>{{$u->name}}</div>
                </div>
                @endforeach
                <div>
                    <h1>{{$title}}</h1>
                    <p>{{$createtime}}</p>
                </div>
                <div id="artCon">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <h3>目的地 : <h3>
                                </td>
                                <td>{{$arrive}}</td>
                            </tr>
                            <tr>
                                @if($value == 1)
                                <td>我有車</td>
                                @elseif($value == 2)
                                <td>找包車</td>
                                @endif
                            </tr>
                            <tr>
                                <td>
                                    <h3>出發日期 : </h3>
                                </td>
                                <td>{{$departdate}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>回程日期 : </h3>
                                </td>
                                <td>{{$returndate}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>出發地點 : </h3>
                                </td>
                                <td>{{$depart}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>內建人數 : </h3>
                                </td>
                                <td>{{$original}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>欲徵人數 : </h3>
                                </td>
                                <td>{{$hire}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>包車費用 : </h3>
                                </td>
                                <td>{{$cost}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="height: 50px;">
                                    <h3>備註 : </h3>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2" style="height: 50px;">{{$note}}</td>
                            </tr>
                        </table>
                    </div>
                    <div style="height: 50px;"></div>

                </div>

            </div>

            <div id="content2">
                @if(Auth::check())
                @if($uid != $id)
                @if($n1 == 0)
                <form method="post" action="" data-ajax="true">
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
            </div>

            <div id="carpool-comment">
                @if($comments == null)
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
                @else
                <div id="mesHis">
                    @foreach($comments as $comment)
                    <div class="headDiv">
                        <div class="headDivChi">
                            <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $comment->upicture)}}">
                            <p>{{$comment->name}}</p>
                        </div>
                        <div class="headDivChi2">
                            <div>{{$comment->content}}</div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                @endif

                <!-- 留言 -->
                <div id="mes">
                    @if (Auth::check())
                    <form method="post" action=" " id="myForm">
                        @csrf
                        @foreach($userDatas as $userData)
                        <div class="formPic">
                            <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}">
                            <p>{{$userData->name}} ></p>
                        </div>
                        @endforeach
                        <textarea name="cpcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                        <input id="submitBtn" type="submit" value="-送出-">
                    </form>
                    <script src="{{ asset('js/formtrim.js') }}"></script>
                    @else
                    <form method="post" action="#">
                        @csrf
                        @foreach($userDatas as $userData)
                        <div class="formPic">
                            <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}">
                            <p>{{$userData->name}} ></p>
                        </div>
                        @endforeach
                        <textarea name="feelcom" id="" cols="30" rows="10" placeholder="你需要先登入才能留言喔～" disabled></textarea>
                        <input type="button" value="-送出-">
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="column2">
            <aside>
                <h1>-最新文章-</h1>
                <div class="article2">
                    <div class="article2Con">
                        <a href="#">
                            <h4>AAAAAAA</h4>
                        </a>
                        <p>作者：AAAAAAAA</p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <div class="abcc"></div>

    @endsection