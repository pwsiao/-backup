@extends('main')


@section('head')
<title>論壇討論串發表/留言紀錄 | 與山同行</title>
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
                    <div class="editArticle">
                        <div class="articleDate">
                            {{ $forumArticle->date }}
                        </div>
                        <div class="articleTitle">
                            @if( !$forumArticle->state)
                            <span>[草稿]</span>&nbsp;
                            @endif
                            {{ $forumArticle->title }}
                        </div>
                        <div class="buttons">
                            @if( $forumArticle->state )
                            <a href="{{route('fodetail',[ 'sfid'=>$forumArticle->sfid, 'foid'=>$forumArticle->foid ] )}}"><button name="" id="" class="operate" type="submit">查看</button></a>
                            @endif
                            <form method="POST" action="{{ route('editForum') }}">
                                @csrf
                                <button type="submit" name="" id="" class="operate">編輯</button>
                                <input type="hidden" name="foid" value="{{ $forumArticle->foid }}">
                            </form>
                            <form method="POST" action="{{ route('delForum', ['foid' => $forumArticle->foid]) }}" onsubmit="return confirm('確定要刪除嗎？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="" id="" class="operate">刪除</button>
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
                    <div class="viewArticle">
                        <div class="articleDate">
                            {{ $forumComment->date }}
                        </div>
                        <div class="articleTitleComment">
                            <div class="articleTitle">{{ $forumComment->title }}</div>
                            <div class="articleComment">
                                留言內容：<br />
                                {{ $forumComment->forumComment }}
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="{{route('fodetail',[ 'sfid'=>$forumArticle->sfid, 'foid'=>$forumArticle->foid ] )}}"><button type="button" name="" id="" class="operate">檢視文章</button></a>
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