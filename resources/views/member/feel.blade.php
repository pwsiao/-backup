@extends('main')


@section('head')
<title>心得發表/留言紀錄 | 與山同行</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/member-all.css')}}">
<link rel="stylesheet" href="{{asset('css/feel.css')}}">
<script type="text/javascript" src="{{asset('js/member-all.js')}}"></script>

@endsection


@section('content')
<div id="content-container">
    <div id="pageHeader">
        <h1>心得</h1>
    </div>

    <div id="mainContent">

    @include('member.leftBar')

        <div class="pageContent">
            <div id="feelRecord">
                <h2>我的心得</h2>
                @if(count($feelList) > 0)
                    @foreach($feelList as $feelArticle)
                    <div class="editArticle">
                        <div class="articleDate">
                            {{ $feelArticle->date }}
                        </div>
                        <div class="articleTitle">
                            @if( !$feelArticle->state)
                            <span>[草稿]</span>&nbsp;
                            @endif
                            {{ $feelArticle->title }}
                        </div>
                        <div class="buttons">
                            @if( $feelArticle->state )
                            <a href="{{route('fedetail',[ 'id'=>$feelArticle->fid ] )}}"><button name="" id="" class="operate" type="submit">查看</button></a>
                            @endif
                            <form method="POST" action="{{ route('editFeel') }}">
                                @csrf
                                <button type="submit" name="" id="" class="operate">編輯</button>
                                <input type="hidden" name="fid" value="{{ $feelArticle->fid }}">
                            </form>
                            <form method="POST" action="{{ route('delFeel', ['fid' => $feelArticle->fid]) }}" onsubmit="return confirm('確定要刪除嗎？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="" id="" class="operate">刪除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="article">
                        目前沒有分享心得，快去<a href="{{ route('feindex') }}">心得</a>分享經驗吧！
                    </div>
                @endif
            </div>
            <hr />
            <div id="comment">
                <h2>我的留言</h2>
                @if(count($feelComments) > 0)
                    @foreach($feelComments as $feelComment)
                    <div class="viewArticle">
                        <div class="articleDate">
                            {{ $feelComment->date }}
                        </div>
                        <div class="articleTitleComment">
                            <div class="articleTitle">{{ $feelComment->title }}</div>
                            <div class="articleComment">
                                留言內容：<br />
                                {{ $feelComment->feelComment }}
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="{{ route('fedetail', ['id'=>$feelComment->fid]) }}"><button type="button" name="" id="" class="operate">檢視文章</button></a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="article">
                        目前沒有留言，快去<a href="{{ route('feindex') }}">心得</a>看看別人的分享吧！
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection