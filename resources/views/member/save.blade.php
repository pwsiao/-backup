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
                <div class="article">
                    <div class="articleDate">
                        3/15
                    </div>
                    <div class="articleTitle">
                        【六順山七彩湖】五天步行107公里-探訪中央山脈心臟地帶
                    </div>
                </div>
                <div class="article">
                    <div class="articleDate">
                        2/13
                    </div>
                    <div class="articleTitle">
                        2023 臺北大縱走 7：飛龍步道至指南宮竹柏參道
                    </div>
                </div>
                <div class="article">
                    <div class="articleDate">
                        1/5
                    </div>
                    <div class="articleTitle">
                        新手登山常見的 12 個問題（高山症、雨衣、備用衣物、山屋、上廁所、生理期、體能）
                    </div>
                </div>
            </div>
            <hr />
            <div id="forumSave">
                <h2>論壇</h2>
                <div class="article">
                    <div class="articleDate">
                        3/18
                    </div>
                    <div class="articleTitle">
                        魚路古道：石門的茶金歲月
                    </div>
                </div>
                <div class="article">
                    <div class="articleDate">
                        1/5
                    </div>
                    <div class="articleTitle">
                        【羊畢羊 一日單攻 】鋸齒連峰值得一探嗎？畢祿山風景超讚！
                    </div>
                </div>
                <div class="article">
                    <div class="articleDate">
                        1/3
                    </div>
                    <div class="articleTitle">
                        【裝備】繞境裝備怎麼帶？大甲媽祖穿搭一次看！
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection