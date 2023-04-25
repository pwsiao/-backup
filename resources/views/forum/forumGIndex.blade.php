@extends('main')


@section('head')
<title>論壇首頁</title>
    <link rel="stylesheet" href="{{ asset('css/forumQIndex.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

@endsection


@section('content')
<div id="content-container">
            <br>
            <div class="row">
                <div class="column1">
                    <h1>論壇</h1>
                    <div id="tabContainer">
                        <div class="tab">
                            <button class="tablinks"  onclick="window.location.href ='{{route('foqindex')}}'">問題</button>
                            <button class="tablinks"  onclick="openCity(event, 'Paris')" id="defaultOpen">揪團</button>
                            <button class="tablinks" onclick="window.location.href ='{{route('fohindex')}}'" >黑特</button>
                        </div>
                        <div id="abc" class="tabcontent">
                        </div>
                        <div id="Paris" class="tabcontent">
                            <form class="example" type="get" action="{{ route('fogindex') }}">
                                <input type="text" placeholder="輸入關鍵字" name="search" id="search-input">
                                <button type="submit" id="searchbt-paris" class="BU">搜索</button>
                            </form>
                            <div id="articles">
                            @if(isset($Goutputs))
                                @if($Goutputs->isEmpty())
                                    <div class="article">
                                        <p>查無相關資料</p>
                                    </div>
                                @else
                                    @foreach($Goutputs as $Goutput)
                                    <div class="article">
                                        <div class="articlePic">                 
                                            <img src="{{$Goutput->fpicture}}" >
                                        </div>
                                        <div class="articleCon">
                                            <a href="{{route('fodetail',[ 'sfid'=> 2, 'foid'=>$Goutput->foid ] )}}">
                                                <h4 class="searchtitle">{{$Goutput->title}}</h4>
                                            </a>
                                            <h5>作者：{{$Goutput->name}}</h5>
                                            <h5>發布日期：{{$Goutput->createtime}}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{$Goutputs->links() }} 
                                @endif                               
                            @else          
                                @foreach($groups as $group)
                                            <div class="article">
                                                <div class="articlePic">                 
                                                    <img src="{{$group->fpicture}}" >
                                                </div>
                                                <div class="articleCon">
                                                    <a href="{{route('fodetail',[ 'sfid'=> 2, 'foid'=>$group->foid ] )}}">
                                                        <h4 class="searchtitle">{{$group->title}}</h4>
                                                    </a>
                                                    <h5>作者：{{$group->name}}</h5>
                                                    <h5>發布日期：{{$group->createtime}}</h5>
                                                </div>
                                            </div>
                                @endforeach
                                {{ $groups->links() }} 
                            @endif
                            </div>
                        </div>
                        <div id="Tokyo" class="tabcontent">
                        </div>
                    </div>
                </div>

<script src="{{ asset('js/forumIndex.js') }}"></script>

            @auth
                <button id="btPublish" onclick="window.location.href ='{{ route('fomes')}}'">
                    發文
                </button>
            @endauth
                    <aside class="column2">
                        <h1>-最新文章-</h1>
                        @foreach($forumNew2s as $forumNew2)
                            <div class="article2">
                                <div class="article2Con">
                                    <a href="{{ route('fodetail',['sfid'=>$forumNew2->sfid,'foid'=>$forumNew2->foid])}}">
                                        <h4>{{$forumNew2->title}}</h4>
                                    </a>
                                    <div class="new">
                                    @if(empty($forumNew2->upicture))
                                        <img class="newpic" src="{{ asset('pic/admin.png') }}" alt="">
                                    @else
                                        <img class="newpic" src="{{$forumNew2->upicture}}">
                                    @endif                                            
                                        <span class="newname">{{$forumNew2->name}}</span>
                                        <br>
                                        <br>
                                        <span class="newtime">{{$forumNew2->createtime}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                    </aside>
                </div>
            </div>

            <!-- <div id="abcc"></div> -->


 @endsection
