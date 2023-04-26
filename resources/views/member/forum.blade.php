@extends('main')


@section('head')
<title>論壇</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/member-all.css')}}">
<link rel="stylesheet" href="{{asset('css/forum.css')}}">
<script type="text/javascript" src="{{asset('js/member-all.js')}}"></script>

@endsection


@section('content')
<div id="content-container">
    <div id="pageHeader">
        <h1>論壇</h1>
    </div>

    <div id="mainContent">

        @include('member.leftBar')

        <div class="pageContent">
            <div id="forumRecord">
                <h2>我的討論串</h2>
                @if(count($forumList) > 0)
                    @foreach($forumList as $forumArticle)
                    <div class="article">
                        <div class="articleDate">
                            {{ $forumArticle->date }}
                        </div>
                        <div class="articleTitle">
                            @if( !$forumArticle->state)
                            <span>[草稿]</span>
                            @endif
                            {{ $forumArticle->title }}
                        </div>
                        <div class="buttons">
                            <form method="POST" action="{{ route('editForum') }}">
                                @csrf
                                <input type="submit" name="" id="" class="operate" value="編輯">
                                <input type="hidden" name="foid" value="{{ $forumArticle->foid }}">
                            </form>
                            <form method="POST" action="{{ route('delForum', ['foid' => $forumArticle->foid]) }}" onsubmit="return confirm('確定要刪除嗎？')">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="" id="" class="operate" value="刪除">
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="article">
                        目前沒有討論串，快去<a href="{{ route('foqindex') }}">論壇</a>發起討論吧！
                    </div>
                @endif
            </div>
            <hr />
            
            <div id="comment">
                <h2>我的留言</h2>
                @if(count($forumComments) > 0)
                    @foreach($forumComments as $forumComment)
                    <div class="article">
                        <div class="articleDate">
                            {{ $forumComment->date }}
                        </div>
                        <div class="articleTitle">
                            {{ $forumComment->title }}<br>
                            {{ $forumComment->forumComment }}
                        </div>
                        <div class="buttons">
                            <input type="button" name="" id="" class="operate" value="檢視文章" onclick="location.href='{{ route('fodetail', ['foid'=>$forumComment->foid, 'sfid'=>$forumComment->sfid]) }}'">
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="article">
                        目前沒有留言，快去<a href="{{ route('foqindex') }}">論壇</a>參與討論吧！
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection