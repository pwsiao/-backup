@extends('main')


@section('head')
<title>心得文章內容</title>
<link rel="stylesheet" href="{{ asset('css/feelDetail.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

@endsection


@section('content')
<div id="content-container">
    <div class="abc"></div>
    <div class="row">
        <div class="column1">
            <!-- 文章內容 -->
            <div id="content">
                @foreach($article as $article1)
                <div>
                    <img src="data:image/jpeg;base64,{{base64_encode( $article1->upicture)}}">
                    <div>{{$article1->name}}</div>
                    @auth
                        <a id="heartHref" href="{{route('fesave',[ 'uid'=>$uid, 'ftid'=>$ftid ] )}}">
                            <i class="bi bi-suit-heart-fill" id="heart"></i>
                        </a>
                        @endauth
                </div>
                <div>
                    <h1>{{ $article1->title}}</h1>
                    <p>{{ $article1->createtime}}</p>
                </div>
                <div id="imgDiv">
                    <img src="data:image/jpeg;base64,{{base64_encode( $article1->fpicture)}}">
                </div>
                <div id="artCon">
                    {{$article1->content}}
                </div>
                @endforeach
            </div>
        @auth
            <script>
                // 获取图标元素和链接元素
                const heartIcon = document.getElementById('heart');
                const heartHref = document.getElementById('heartHref');
                const uid = heartHref.dataset.uid;
                const ftid = heartHref.dataset.ftid;
                // 初始化图标状态
                let isRed = localStorage.getItem('isRed') === 'true';
                if (isRed) {
                    heartIcon.classList.add('text-danger');
                    heartHref.href = "{{route('fesave',[ 'uid'=>$uid, 'ftid'=>$ftid ] )}}";
                }
                // 监听点击事件
                heartIcon.addEventListener('click', () => {
                    // 切换图标颜色
                    if (isRed) {
                        heartIcon.classList.remove('text-danger');
                        isRed = false;
                        localStorage.setItem('isRed', 'false');
                        heartHref.href = "{{route('feunsave',[ 'uid'=>$uid, 'ftid'=>$ftid ] )}}";
                        alert("取消收藏");
                    } else {
                        heartIcon.classList.add('text-danger');
                        isRed = true;
                        localStorage.setItem('isRed', 'true');
                        heartHref.href = "{{route('fesave',[ 'uid'=>$uid, 'ftid'=>$ftid ] )}}";
                        alert("收藏成功");
                    }
                });
            </script>
        @endauth
            @if($comments == null)
            <div id="mesHis">
                <div class="headDiv">
                    <div class="headDivChi">
                    </div>
                    <div class="headDivChi2">
                        <p>還沒有人留言喔～</p>
                        <p>快來當頭香～</p>
                    </div>
                </div>
                <hr>
            </div>
            @else
            <div id="mesHis">
                @foreach($comments as $comment)
                <div class="headDiv">
                    <div class="headDivChi">
                        <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $comment->upicture)}}">
                        <p>{{$comment->name}}</p>
                    </div>
                    <div class="headDivChi2">
                        <div>{{$comment->content}}</div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            @endif

            <!-- 留言 -->
            <div id="mes">
                @if (Auth::check())
                <form method="post" action="{{route('feelcom',['ftid'=>$ftid,'uid'=>$uid])}}" id="myForm">
                    @csrf
                    @foreach($userDatas as $userData)
                    <div class="formPic">
                        <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}">
                        <p>{{$userData->name}} ></p>
                    </div>
                    @endforeach
                    <textarea name="feelcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                    <input id="submitBtn" type="submit" value="-送出-">
                </form>
                <script src="{{ asset('js/formtrim.js') }}"></script>
                @else
                <form method="post" action="#">
                    @csrf
                    @foreach($userDatas as $userData)
                    <div class="formPic">
                        <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}">
                        <p>{{$userData->name}} ></p>
                    </div>
                    @endforeach
                    <textarea name="feelcom" id="" cols="30" rows="10" placeholder="你需要先登入才能留言喔～" disabled></textarea>
                    <input type="button" value="-送出-">
                </form>
                @endif
            </div>
        </div>
        <div class="column2">
            <aside>
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
</div>
<div class="abcc"></div>

@endsection