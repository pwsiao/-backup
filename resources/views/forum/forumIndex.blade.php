@extends('main')


@section('head')
<title>論壇首頁</title>
    <link rel="stylesheet" href="{{ asset('css/forumIndex.css') }}">
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
                            <button class="tablinks" onclick="openCity(event, 'abc')" id="defaultOpen">問題</button>
                            <button class="tablinks" onclick="openCity(event, 'Paris')">揪團</button>
                            <button class="tablinks" onclick="openCity(event, 'Tokyo')">黑特</button>
                        </div>
                        <div id="abc" class="tabcontent">
                            <form class="example" type="get" action="{{ route('foindex') }}">
                                <input type="text" placeholder="輸入關鍵字" name="search" id="search-input">
                                <button type="submit" id="searchbt">搜索</button>
                            </form>
                            <div id="articles">
                            @if(isset($Qoutputs))
                                @if($Qoutputs->isEmpty())
                                    <div class="article">
                                        <p>查無相關資料</p>
                                    </div>
                                @else
                                @foreach($Qoutputs as $Qoutput)
                                <div class="article">
                                    <div class="articlePic">                 
                                        <img src="data:image/jpeg;base64,{{base64_encode($Qoutput->fpicture)}}" >
                                    </div>
                                    <div class="articleCon">
                                        <a href="{{route('fodetail',[ 'sfid'=> 1, 'foid'=>$Qoutput->foid ] )}}">
                                            <h4 class="searchtitle">{{$Qoutput->title}}</h4>
                                        </a>
                                        <h5>作者：{{$Qoutput->name}}</h5>
                                        <h5>發布日期：{{$Qoutput->createtime}}</h5>
                                    </div>
                                </div>
                                @endforeach
                                {{$Qoutputs->links() }} 
                                @endif   
                            @else          
                                @foreach($questions as $question)
                                        <div class="article">
                                            <div class="articlePic">                 
                                                <img src="data:image/jpeg;base64,{{base64_encode($question->fpicture)}}" >
                                            </div>
                                            <div class="articleCon">
                                                <a href="{{route('fodetail',[ 'sfid'=> 1, 'foid'=>$Qoutput->foid ] )}}">
                                                    <h4 class="searchtitle">{{$question->title}}</h4>
                                                </a>
                                                <h5>作者：{{$question->name}}</h5>
                                                <h5>發布日期：{{$question->createtime}}</h5>
                                            </div>
                                        </div>
                                @endforeach
                                {{ $questions->links() }} 
                            @endif
                            </div>
                        </div>
                        <div id="Paris" class="tabcontent">
                            <form class="example" type="get" action="{{ route('foindex') }}">
                                <input type="text" placeholder="輸入關鍵字" name="search" id="search-input">
                                <button type="submit" id="searchbt">搜索</button>
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
                                            <img src="data:image/jpeg;base64,{{base64_encode($Goutput->fpicture)}}" >
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
                                                    <img src="data:image/jpeg;base64,{{base64_encode($group->fpicture)}}" >
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
                            <form class="example">
                                <input type="text" placeholder="輸入關鍵字" name="search" id="search-input">
                                <button type="submit" id="searchbt" type="get" action="{{ route('foindex') }}">搜索</button>
                            </form>
                            <div id="articles">
                            @if(isset($Houtputs))
                                @if($Houtputs->isEmpty())
                                    <div class="article">
                                        <p>查無相關資料</p>
                                    </div>
                                @else
                                    @foreach($Houtputs as $Houtput)
                                    <div class="article">
                                        <div class="articlePic">                 
                                            <img src="data:image/jpeg;base64,{{base64_encode($Houtput->fpicture)}}" >
                                        </div>
                                        <div class="articleCon">
                                            <a href="{{route('fodetail',[ 'sfid'=> 3, 'foid'=>$Houtput->foid ] )}}">
                                                <h4 class="searchtitle">{{$Houtput->title}}</h4>
                                            </a>
                                            <h5>作者：{{$Houtput->name}}</h5>
                                            <h5>發布日期：{{$Houtput->createtime}}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{$Houtputs->links() }} 
                                @endif                               
                            @else          
                                @foreach($haters as $hater)
                                    <div class="article">
                                        <div class="articlePic">                 
                                            <img src="data:image/jpeg;base64,{{base64_encode($hater->fpicture)}}" >
                                        </div>
                                        <div class="articleCon">
                                            <a href="{{route('fodetail',[ 'sfid'=> 3, 'foid'=>$hater->foid ] )}}">
                                                <h4 class="searchtitle">{{$hater->title}}</h4>
                                            </a>
                                            <h5>作者：{{$hater->name}}</h5>
                                            <h5>發布日期：{{$hater->createtime}}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $haters->links() }} 
                            @endif
                            </div>
                        </div>
                    </div>
                    

                </div>
            <script src="{{ asset('js/forumIndex.js') }}"></script>
            @auth
                <?php
                    $url = route('fomes',[ 'uid'=> $uid ] )
                ?>
                <button id="btPublish" onclick="window.location.href ='{{ $url}}'">
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
                                    <p>作者：{{$forumNew2->name}}</p>
                                </div>
                            </div>
                        @endforeach    
                    </aside>
                </div>
            </div>

            <div id="abcc"></div>
 </div>

@endsection
