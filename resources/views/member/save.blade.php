@extends('main')


@section('head')
<title>心得/討論串收藏 | 個人頁面</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/member-all.css')}}">
<link rel="stylesheet" href="{{asset('css/save.css')}}">
<script type="text/javascript" src="{{asset('js/member-all.js')}}"></script>

@endsection


@section('content')
<div id="content-container">
    <div id="pageHeader">
        <h1>收藏</h1>
    </div>

    <div id="mainContent">

        @include('member.leftBar')

        <div class="pageContent">
            <div id="feelSave">
                <h2>心得</h2>
                @if(count($feelSaveList) > 0)
                @foreach($feelSaveList as $feelSaveArticle)
                <div class="viewArticle">
                    <div class="articleDate">
                        {{ $feelSaveArticle->date }}
                    </div>
                    <div class="articleTitle">
                        {{ $feelSaveArticle->title }}<br>
                    </div>
                    <div class="buttons">
                        <a href="{{ route('fedetail', ['id'=>$feelSaveArticle->fid]) }}"><button type="button" name="" id="" class="operate">檢視文章</button></a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="article">
                    目前沒有收藏心得，快去<a href="{{ route('feindex') }}">心得</a>看看別人的分享吧！
                </div>
                @endif
            </div>

            <hr />

            <div id="forumSave">
                <h2>論壇</h2>
                @if(count($forumSaveList) > 0)
                @foreach($forumSaveList as $forumSaveArticle)
                <div class="viewArticle">
                    <div class="articleDate">
                        {{ $forumSaveArticle->date }}
                    </div>
                    <div class="articleTitle">
                        {{ $forumSaveArticle->title }}<br>
                    </div>
                    <div class="buttons">
                        {{-- <form method="post" action="{{ route('goToForum') }}">
                            @csrf
                            <button type="submit" name="" id="" class="operate">檢視文章</button>
                            <input type="hidden" name="foid" value="{{ $forumSaveArticle->foid }}">
                        </form> --}}
                        <a href="{{route('fodetail',[ 'sfid'=>$forumSaveArticle->sfid, 'foid'=>$forumSaveArticle->foid ] )}}"><button type="button" name="" id="" class="operate">檢視文章</button></a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="article">
                    目前沒有收藏討論串，快去<a href="{{ route('foqindex') }}">論壇</a>看看別人的討論串吧！
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection