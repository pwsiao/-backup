@extends('main')


@section('head')
<title>心得首頁</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/ftest.css') }}">
<link rel="stylesheet" href="{{ asset('css/feelIndex.css') }}">

@endsection


@section('content')
<div id="content-container">
    <div class="row">
        <div class="column1">
            <div class="abcc"></div>
            <h1>心得</h1>
            <div>
                <form class="example" type="get" action="{{ route('feindex') }}">
                    <input type="text" placeholder="輸入關鍵字" name="search" id="search-input">
                    <button type="submit" id="searchbt">搜索</button>
                </form>
                <br>
                <div id="articles">
                    @if(isset($outputs))
                    @foreach($outputs as $output)
                    <div class="article">
                        <div class="articlePic">
                            <img src="data:image/jpeg;base64,{{base64_encode($output->fpicture)}}">
                        </div>
                        <div class="articleCon">
                            <a href="{{route('fedetail',[ 'id'=> $output->fid ] )}}">
                                <h4 class="searchtitle">{{$output->title}}</h4>
                            </a>
                            <h5>作者：{{$output->name}}</h5>
                            <h5>發布日期：{{$output->createtime}}</h5>
                        </div>
                    </div>
                    @endforeach
                    {{ $outputs->links() }}
                    @if($outputs->isEmpty())
                    <div class="article">
                        <p>查無相關資料</p>
                    </div>
                    @endif
                    @else
                    @foreach($datas as $data)
                    <div class="article">
                        <div class="articlePic">
                            <img src="data:image/jpeg;base64,{{base64_encode($data->fpicture)}}">
                        </div>
                        <div class="articleCon">
                            <a href="{{route('fedetail',[ 'id'=> $data->fid ] )}}">
                                <h4 class="searchtitle">{{$data->title}}</h4>
                            </a>
                            <h5>作者：{{$data->name}}</h5>
                            <h5>發布日期：{{$data->createtime}}</h5>
                        </div>
                    </div>
                    @endforeach
                    {{ $datas->links() }}
                    @endif
                </div>
            </div>

        </div>
        <script src="{{ asset('js/forumIndex.js') }}"></script>

        @auth
        <?php
        $url = route('femes', ['uid' => $uid])
        ?>
        <button id="btPublish" onclick="window.location.href ='{{ $url}}'">
            發文
        </button>
        @endauth

        <aside class="column2">
            <h1>-最新文章-</h1>
            @foreach($datas as $data)
            <div class="article2">
                <div class="article2Con">
                    <a href="{{route('fedetail',[ 'id'=> $data->fid ] )}}">
                        <h4>{{$data->title}}</h4>
                    </a>
                    <p>作者：{{$data->name}}</p>
                </div>
            </div>
            @endforeach
        </aside>
    </div>
</div>
<div class="abc"></div>

@endsection