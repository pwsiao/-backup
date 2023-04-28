@extends('main')


@section('head')
    <title>論壇首頁</title>
    <link rel="stylesheet" href="{{ asset('css/forumQIndex.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection


@section('content')
    <div id="content-container">
        <div class="row">
            <div class="column1">
                <h1>論壇</h1>
                @auth
                    <button id="btPublish" onclick="window.location.href ='{{ route('fomes') }}'">
                        發文
                    </button>
                @endauth
                <div id="tabContainer">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'abc')" id="defaultOpen">問題</button>
                        <button class="tablinks" onclick="window.location.href ='{{ route('fogindex') }}'">揪團</button>
                        <button class="tablinks" onclick="window.location.href ='{{ route('fohindex') }}'">黑特</button>
                    </div>
                    <div id="abc" class="tabcontent">
                        <form class="example" type="get" action="{{ route('foqindex') }}">
                            <input type="text" placeholder="輸入關鍵字" name="search" id="search-input"
                                value="{{ $search }}">
                            <button type="submit" id="searchbt-abc" class="BU">搜索</button>
                        </form>
                        <div id="articles">
                            @if (isset($Qoutputs))
                                @if ($Qoutputs->isEmpty())
                                    <div class="article">
                                        <p>查無相關資料</p>
                                    </div>
                                @else
                                    @foreach ($Qoutputs as $Qoutput)
                                        <a href="{{ route('fodetail', ['sfid' => 1, 'foid' => $Qoutput->foid]) }}"
                                            class="linking">
                                            <div class="article">
                                                <div class="articlePic">
                                                    <img src="{{ $Qoutput->fpicture }}" class="articleImg">
                                                </div>
                                                <div class="articleCon">
                                                    <!-- <a href="{{ route('fodetail', ['sfid' => 1, 'foid' => $Qoutput->foid]) }}"> -->
                                                    <h2 class="searchtitle">{{ $Qoutput->title }}</h2>
                                                    <!-- </a> -->
                                                    <p>作者：{{ $Qoutput->name }}</p>
                                                    <p>發布日期：{{ $Qoutput->date }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    {{ $Qoutputs->links() }}
                                @endif
                            @else
                                @foreach ($questions as $question)
                                    <a href="{{ route('fodetail', ['sfid' => 1, 'foid' => $Qoutput->foid]) }}">
                                        <div class="article">
                                            <div class="articlePic">
                                                <img src="{{ question->fpicture }}">
                                            </div>
                                            <div class="articleCon">
                                                <h4 class="searchtitle">{{ $question->title }}</h4>
                                                <h5>作者：{{ $question->name }}</h5>
                                                <h5>發布日期：{{ $question->createtime }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                {{ $questions->links() }}
                            @endif
                        </div>
                    </div>
                </div>

                <script src="{{ asset('js/forumIndex.js') }}"></script>

            </div>
            <aside class="column2">
                <h1>-最新文章-</h1>
                @foreach ($forumNew2s as $forumNew2)
                    <a href="{{ route('fodetail', ['sfid' => $forumNew2->sfid, 'foid' => $forumNew2->foid]) }}"
                        class="linking2">
                        <div class="article2">
                            <div class="article2Con">
                                <h3>{{ $forumNew2->title }}</h3>
                                <div class="new">
                                    @if (empty($forumNew2->upicture))
                                        <img class="newpic" src="{{ asset('pic/admin.png') }}" alt="">
                                    @else
                                        <img class="newpic" src="{{ $forumNew2->upicture }}">
                                    @endif
                                    <span class="newname">{{ $forumNew2->name }}</span><br />
                                    <span class="newtime">{{ $forumNew2->date }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </aside>
        </div>
    @endsection
