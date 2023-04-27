@extends('main')


@section('head')
<title>登山心得 | 與山同行</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/feelIndex.css') }}">

@endsection


@section('content')
<div id="content-container">
    <div class="row">
        <div class="column1">
            <h1>心得</h1>
            @auth
                <button id="btPublish" onclick="window.location.href = '{{ route('femes')}}'">
                    發文
                </button>
            @endauth
            <div>
                <div id="articles">
                    <form class="example" type="get" action="{{ route('feindex') }}">
                        <input type="text" placeholder="輸入關鍵字" name="search" id="search-input" value="{{$search}}">
                        <button type="submit" id="searchbt">搜索</button>
                    </form>    
                    @if(isset($outputs))
                        @foreach($outputs as $output)
                        <a href="{{route('fedetail',[ 'id'=> $output->fid ] )}}" class="linking">
                            <div class="article">
                                <div class="articlePic">
                                    <img src="{{$output->fpicture}}">
                                </div>
                                <div class="articleCon">                            
                                    <h2 class="searchtitle">{{$output->title}}</h2>
                                    <p>作者：{{$output->name}}</p>
                                    <p>發布日期：{{$output->date}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        {{ $outputs->links() }}
                            @if($outputs->isEmpty())
                            <div class="article">
                                <p>查無相關資料</p>
                            </div>
                            @endif
                    @else
                        @foreach($datas as $data)
                        <a href="{{route('fedetail',[ 'id'=> $data->fid ] )}}" class="linking">
                            <div class="article">
                                <div class="articlePic">
                                    <img src="{{$data->fpicture}}">
                                </div>
                                <div class="articleCon">
                                        <h4 class="searchtitle">{{$data->title}}</h4>                              
                                    <h5>作者：{{$data->name}}</h5>
                                    <h5>發布日期：{{$data->date}}</h5>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        {{ $datas->links() }}
                    @endif
                </div>
            </div>

        </div>

        

        <aside class="column2">
            <h1>-最新文章-</h1>
            @foreach($datas as $data)
            <a href="{{route('fedetail',[ 'id'=> $data->fid ] )}}" class="linking2">
                <div class="article2">
                    <div class="article2Con">
                            <h3>{{$data->title}}</h3>
                        <div class="new">
                            @if(empty($data->upicture))
                                <img class="newpic" src="{{ asset('pic/admin.png') }}" alt="">
                            @else
                                <img class="newpic" src="{{$data->upicture}}">
                            @endif                               
                            <span class="newname">{{$data->name}}</span><br />
                            <span class="newtime">{{$data->date}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </aside>
    </div>
</div>

@endsection