@extends('main')


@section('head')
<title>論壇文章內容</title>
    <link rel="stylesheet" href="{{ asset('css/forumDetail.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

@endsection


@section('content')
<div id="content-container">
            <div class="abc"></div>
            <div class="row">
                <div class="column1">
                    <!-- 文章內容 -->
                    <div id="content">
                    @if(isset($articles))
                        @foreach($articles as $article)
                        <div>
                        <img src="data:image/jpeg;base64,{{base64_encode( $article->upicture)}}" >
                            <div>{{$article->name}}</div>
                            @auth
                                <a id="heartHref" href="{{route('fosave',[ 'sfid'=>$sfid, 'uid'=>$uid, 'ftid'=>$foid ] )}}">
                                    <i class="bi bi-suit-heart-fill" id="heart"></i>
                                </a>
                            @endauth
                        </div>
                        <div>
                            <h1>{{$article->title}}</h1>
                            <p>{{$article->createtime}}</p>
                        </div>
                        <div id="imgDiv">
                            <img src="data:image/jpeg;base64,{{base64_encode( $article->fpicture)}}" >
                        </div>
                        <div>
                            {{$article->content}}
                        </div>
                        @endforeach
                    @else
                        <div>nonono</div>
                    @endif
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
                            heartHref.href = "{{route('fosave',[ 'sfid'=>$sfid, 'uid'=>$uid, 'ftid'=>$foid ] )}}";
                        }
                    
                        // 监听点击事件
                        heartIcon.addEventListener('click', () => {
                            // 切换图标颜色
                            if (isRed) {
                                heartIcon.classList.remove('text-danger');
                                isRed = false;
                                localStorage.setItem('isRed', 'false');
                                heartHref.href = "{{route('founsave',[ 'sfid'=>$sfid, 'uid'=>$uid, 'ftid'=>$foid ] )}}";
                                alert("取消收藏");
                        
                            } else {
                                heartIcon.classList.add('text-danger');
                                isRed = true;
                                localStorage.setItem('isRed', 'true');
                                heartHref.href = "{{route('fosave',[ 'sfid'=>$sfid, 'uid'=>$uid, 'ftid'=>$foid ] )}}";
                                alert("收藏成功");   
                            }
                        });
                    </script>
                    @endauth
                    <!-- 留言紀錄 -->
                    @if($FCquestions == null)
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
                        @foreach($FCquestions as $FCquestion)
                            <div class="headDiv">
                                <div class="headDivChi">
                                    <img src="data:image/jpeg;base64,{{base64_encode($FCquestion->upicture)}}" >
                                    <p>{{$FCquestion->name}}</p>
                                </div>
                                <div class="headDivChi2">
                                    <p>{{$FCquestion->content}}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        </div>
                    @endif



                    
                    <!-- 留言 -->
                    <div id="mes">
                    @if (Auth::check())
                        <form method="post" action="{{ route('forumcom',['sfid'=>$sfid,'foid'=>$foid,'uid'=>$uid])}}" id="myForm">
                            @csrf
                            @foreach($userDatas as $userData)
                            <div class="formPic">
                                <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}" >
                                <p>{{$userData->name}} ></p>
                            </div>
                            @endforeach
                                <textarea name="forumcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                                <input type="submit" id="submitBtn" value="-送出-">
                        </form>
                        <script src="{{ asset('js/formtrim.js') }}"></script>
                    @else
                        <form method="post" action="#">
                            @csrf
                            @foreach($userDatas as $userData)
                            <div class="formPic">
                                <img class="headDivPic" src="data:image/jpeg;base64,{{base64_encode( $userData->upicture)}}" >
                                <p>{{$userData->name}} ></p>
                            </div>
                            @endforeach
                                <textarea name="forumcom" id="" cols="30" rows="10" placeholder="你需要先登入才能留言喔～" disabled></textarea>
                                <input type="button" value="-送出-">
                        </form>
                    @endif
                    </div>
                </div>
                <div class="column2">
                    <aside>
                        <h1>最新文章</h1>
                        @foreach($forumNews as $forumNew)
                            <div class="article2">
                                <div class="article2Con">
                                    <a href="{{route('fodetail',[ 'sfid'=> $forumNew->sfid, 'foid'=>$forumNew->foid ] )}}">
                                        <h4>{{$forumNew->title}}</h4>
                                    </a>
                                    <p>作者：{{$forumNew->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
 
        <div class="abcc"></div>

@endsection