@extends('main')


@section('head')
<title>心得</title>
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
                @foreach($feelList as $feelArticle)
                <div class="article">
                    <div class="articleDate">
                        {{ $feelArticle->date }}
                    </div>
                    <div class="articleTitle">
                        @if( !$feelArticle->state)
                        <span>[草稿]</span>
                        @endif
                        {{ $feelArticle->title }}
                    </div>
                    <div class="buttons">
                        <form method="POST" action="{{ route('editFeel') }}">
                            @csrf
                            <input type="submit" name="" id="" class="operate" value="編輯">
                            <input type="hidden" name="fid" value="{{ $feelArticle->fid }}">
                        </form>
                        <form method="POST" action="{{ route('delFeel', ['fid' => $feelArticle->fid]) }}" onsubmit="return confirm('確定要刪除嗎？')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="" id="" class="operate" value="刪除">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <hr />
            <div id="comment">
                <h2>我的留言</h2>
                @foreach($feelComments as $feelComment)
                <div class="article">
                    <div class="articleDate">
                        {{ $feelComment->date }}
                    </div>
                    <div class="articleTitle">
                        {{ $feelComment->title }}<br>
                        {{ $feelComment->feelComment }}
                    </div>
                    <div class="buttons">
                        <input type="button" name="" id="" class="operate" value="檢視文章" onclick="location.href='{{ route('fedetail', ['id'=>$feelComment->fid]) }}'">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection