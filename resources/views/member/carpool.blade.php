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
                @if(empty($cp) == false)
                    @foreach($cp as $c)
                            <div class="accordion">
                                <div class="groupDate">
                                    {{$c->departdate}}
                                </div>
                                <div class="groupName">
                                    {{$c->cptitle}}
                                </div>
                                <div class="buttons">
                                    <a href="{{route('cpinfo',[ 'cpid'=>$c->cpid ] )}}"><button name="" id="" class="operate" type="submit">查看</button></a>
                                    <form action="{{route('cpedit')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="cpid" value="{{$c->cpid}}">
                                        <button name="" id="" class="operate" type="submit">編輯</button>
                                    </form>
                                    <form action="{{route('cpdelete')}}" method="post" onsubmit="return confirm('確定要刪除嗎？')">
                                        @csrf
                                        <input type="hidden" name="cpid" value="{{$c->cpid}}">
                                        <button name="" id="" class="operate" type="submit">刪除</button>
                                    </form>
                                </div>
                            </div>

                            <div class="panel">                  
                            @foreach($joiner as $jo)
                                @if($jo->cpid == $c->cpid)
                                    <div class="memberList">
                                        <div class="memberPic">
                                            @if(isset($jo->upicture))
                                            <img src="{{$jo->upicture}}" class="memberIcon">
                                            @else
                                            <img src="{{asset('pic/admin.png')}}" class="memberIcon">
                                            @endif
                                        </div>
                                        <div class="memberName">{{$jo->name}}</div>
                                        @if($jo->status == 0)
                                         
                                            @if($c->number < $c->hire)
                                            <div class="memberState">
                                                <form action="{{route('comfirmjoin')}}" method="post">
                                                    @csrf
                                                    <button type="submit" name="cpconfirm" value="1" class="operate">✓</button>
                                                    <button type="submit" name="cpconfirm" value="2" class="operate">✗</button>
                                                    <input type="hidden" name="joiner" value="{{$jo->id}}">
                                                    <input type="hidden" name="cpid" value="{{$c->cpid}}">
                                                </form>
                                            </div>
                                            @else
                                            <div class="memberState">
                                                有緣再會喔
                                            </div>
                                            @endif
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
                @else
                    <div class="accordion">
                    快去發起共乘吧
                    </div>
                @endif
            </div>

            <div id="join">
                <h2>參加中</h2>
                @if(empty($cp2) == false)
                    @foreach($cp2 as $c)
                        <a href="{{route('cpinfo',[ 'cpid'=>$c->cpid ] )}}">
                            <div class="group">
                                <div class="groupDate">
                                    {{$c->departdate}}
                                </div>
                                <div class="groupName">
                                    {{$c->cptitle}}
                                </div>
                                <div class="joinMember">
                                    @foreach($joiner2 as $jo)
                                        @if($jo->cpid == $c->cpid && $jo->status == $c->status)
                                            @if(empty($jo->upicture) == false)
                                            <img src="{{$jo->upicture}}" class="memberIcon">
                                            @else
                                            <img src="{{asset('pic/admin.png')}}" class="memberIcon">
                                            @endif
                                        @endif    
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="group">
                        還沒參加任何共乘唷
                    </div>
                @endif
            </div>


            <div id="join">
                <h2>確認中</h2>
                @if(empty($cp3) == false)
                    @foreach($cp3 as $c)
                        <a href="{{route('cpinfo',[ 'cpid'=>$c->cpid ] )}}">
                            <div class="group">
                                <div class="groupDate">
                                    {{$c->departdate}}
                                </div>
                                <div class="groupName">
                                    {{$c->cptitle}}
                                </div>
                                <form action="{{route('canceljoin')}}" method="post" onsubmit="return confirm('確定要取消嗎？')">
                                @csrf
                                <input type="hidden" name="cpid" value="{{$c->cpid}}">
                                <button name="" id="" class="operate" type="submit">取消</button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="group">
                        沒有確認中的項目唷
                    </div>
                @endif
            </div>





            <div id="finished">
                <h2>歷史紀錄</h2>
                @if(empty($cp4) == false)
                    @foreach($cp4 as $c)
                    <a href="{{route('cpinfo',[ 'cpid'=>$c->cpid ] )}}">
                        <div class="group">
                            <div class="groupDate">
                                {{$c->departdate}}
                            </div>
                            <div class="groupName">
                                {{$c->cptitle}}
                            </div>
                            <div class="joinMember">
                                @foreach($joiner2 as $jo)
                                    @if($jo->cpid == $c->cpid && $jo->status == $c->status)
                                        @if(empty($jo->upicture) == false)
                                        <img src="{{$jo->upicture}}" class="memberIcon">
                                        @else
                                        <img src="{{asset('pic/admin.png')}}" class="memberIcon">
                                        @endif
                                    @endif    
                                @endforeach
                            </div>
                        </div>
                    </a>    
                    @endforeach
                @else  
                    <div class="group">
                            一片空白喔
                    </div>  
                @endif
            </div>
        </div>

    </div>
</div>

@endsection