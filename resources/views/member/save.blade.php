@extends('main')


@section('head')
<title>收藏</title>
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
                @foreach($feelSaveList as $feelSaveArticle)
                <div class="article">
                    <div class="articleDate">
                        {{ $feelSaveArticle->date }}
                    </div>
                    <div class="articleTitle">
                        {{ $feelSaveArticle->title }}<br>
                    </div>
                    <div class="buttons">
                        <input type="button" name="" id="" class="operate" value="檢視文章" onclick="location.href='{{ route('fedetail', ['id'=>$feelSaveArticle->fid]) }}'">
                    </div>
                </div>
                @endforeach
            </div>

            <hr />

            <div id="forumSave">
                <h2>論壇</h2>
                @foreach($forumSaveList as $forumSaveArticle)
                <div class="article">
                    <div class="articleDate">
                        {{ $forumSaveArticle->date }}
                    </div>
                    <div class="articleTitle">
                        {{ $forumSaveArticle->title }}<br>
                    </div>
                    <div class="buttons">
                        <form method="post" action="{{ route('goToForum') }}">
                            @csrf
                            <input type="submit" name="" id="" class="operate" value="檢視文章">
                            <input type="hidden" name="foid" value="{{ $forumSaveArticle->foid }}">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection