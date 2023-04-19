@extends('main')


@section('head')
<title>拼車/揪團紀錄</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/member-all.css')}}">
<link rel="stylesheet" href="{{asset('css/member-carpool.css')}}">
<script type="text/javascript" src="{{asset('js/member-all.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('js/car-record.js')}}"></script> -->

@endsection


@section('content')
<div id="content-container">
    <div id="pageHeader">
        <h1>拼車/揪團紀錄</h1>
    </div>

    <div id="mainContent">

        @include('member.leftBar')

        <div class="pageContent">
            <div id="inProgress">
                <h2>開團中</h2>
                @foreach($cp as $c)
                <div class="accordion">
                    <div class="groupDate">
                        {{$c->departdate}}
                    </div>
                    <div class="groupName">
                        {{$c->cptitle}}
                    </div>
                    <div class="buttons">
                        <button name="" id="" class="operate">編輯</button>
                        <button name="" id="" class="operate">刪除</button>
                    </div>
                </div>
                <div class="panel">
                    @foreach($joiner as $jo)
                    @if($jo->cpid == $c->cpid)
                    <div class="memberList">
                        <div class="memberPic">
                            <img src="./pic/1.jpeg" class="memberIcon">
                        </div>
                        <div class="memberName">{{$jo->name}}</div>
                        @if($jo->status == 0)
                        <div class="memberState">
                            <form action="" method="post">
                                @csrf
                                <button type="submit" name="cpconfirm" value="1" class="operate">✓</button>
                                <button type="submit" name="cpconfirm" value="2" class="operate">✗</button>
                                <input type="hidden" name="joiner" value="{{$jo->id}}">
                                <input type="hidden" name="cpid" value="{{$c->cpid}}">
                            </form>
                        </div>
                        @elseif($jo->status == 1)
                        <div class="memberState">
                            <button name="" id="" class="operate">已加入</button>
                        </div>
                        @elseif($jo->status == 2)
                        <div class="memberState">
                            <button name="" id="" class="operate">已拒絕</button>
                        </div>
                        @endif
                    </div>
                    @elseif($jo->createtime == $c->createtime)
                    <div class="memberList">
                        還沒有人加入哦
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach

                <div class="accordion">
                    <div class="groupDate">
                        3/30
                    </div>
                    <div class="groupName">
                        溪頭之旅
                    </div>
                    <div class="buttons">
                        <button name="" id="" class="operate">編輯</button>
                        <button name="" id="" class="operate">刪除</button>
                    </div>
                </div>
                <div class="panel">
                    <div class="memberList">
                        <div class="memberPic">
                            <img src="./pic/1.jpeg" class="memberIcon">
                        </div>
                        <div class="memberName">阿貓</div>
                        <div class="memberState">
                            <button name="" id="" class="operate">已加入</button>
                        </div>
                    </div>
                    <div class="memberList">
                        <div class="memberPic">
                            <img src="./pic/1.jpeg" class="memberIcon">
                        </div>
                        <div class="memberName">阿狗</div>
                        <div class="memberState">
                            <button name="" id="" class="operate">已加入</button>
                        </div>
                    </div>
                    <div class="memberList">
                        <div class="memberPic">
                            <img src="./pic/1.jpeg" class="memberIcon">
                        </div>
                        <div class="memberName">長頸鹿</div>
                        <div class="memberState">
                            <button name="" id="" class="operate">✓</button>
                            <button name="" id="" class="operate">✗</button>
                        </div>
                    </div>

                </div>

            </div>

            <div id="join">
                <h2>參加中</h2>
                <div class="group">
                    <div class="groupDate">
                        4/20
                    </div>
                    <div class="groupName">
                        尋找幸運の雞
                    </div>
                    <div class="joinMember">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                    </div>
                </div>
            </div>
            <div id="finished">
                <h2>歷史紀錄</h2>
                <div class="group">
                    <div class="groupDate">
                        3/15
                    </div>
                    <div class="groupName">
                        阿里山一日遊
                    </div>
                    <div class="joinMember">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                    </div>
                </div>
                <div class="group">
                    <div class="groupDate">
                        2/28
                    </div>
                    <div class="groupName">
                        陽明山兩天一夜
                    </div>
                    <div class="joinMember">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                    </div>
                </div>
                <div class="group">
                    <div class="groupDate">
                        1/17
                    </div>
                    <div class="groupName">
                        大坑玩耍
                    </div>
                    <div class="joinMember">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                        <img src="./pic/1.jpeg" class="memberIcon">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection