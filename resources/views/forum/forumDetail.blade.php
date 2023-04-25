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
                            @if(empty($article1->upicture))
                                <img src="{{ asset('pic/admin.png') }}" alt="">
                            @else
                                <img src="{{$article->upicture}}">
                            @endif
                            <div>{{$article->name}}</div>
                            @auth
                                <a id="heartHref">
                                    <i class="bi bi-suit-heart-fill" id="heart"></i>
                                </a>
                            @endauth
                        </div>
                        <div>
                            <h1>{{$article->title}}</h1>
                            <p>{{$article->createtime}}</p>
                        </div>
                        <div id="imgDiv">
                            <img src="{{$article->fpicture}}" >
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
                        const isRed = {!! json_encode($isRed) !!};
                        if (isRed.length > 0) {
                            heartIcon.style.color = 'red';
                        }

                        // 监听点击事件
                        heartIcon.addEventListener('click', () => {
                        event.preventDefault();
                        
                          // 切换图标颜色
                        if (isRed.length > 0) {
                          //   heartIcon.classList.add('text-danger');
                        
                        window.location.href = "{{route('founsave',[ 'sfid'=>$sfid, 'ftid'=>$foid ] )}}";
                            alert("取消收藏");
                        } else {
                          //   heartIcon.classList.remove('text-danger');
                            heartIcon.style.color = 'red';
                            window.location.href = "{{route('fosave',[ 'sfid'=>$sfid, 'ftid'=>$foid ] )}}";
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
                                @if(empty($FCquestion->upicture))
                                    <img src="{{ asset('pic/admin.png') }}" alt="">
                                @else
                                    <img src="{{$FCquestion->upicture}}">
                                @endif
                                    <p>{{$FCquestion->name}}</p>
                                </div>
                                <div class="headDivChi2">{{$FCquestion->content}}</div>
                            </div>
                            <hr>
                        @endforeach
                        </div>
                    @endif



                    
                    <!-- 留言 -->
                    <div id="mes">
                    @if (Auth::check())
                        <form method="post" action="{{ route('forumcom',['sfid'=>$sfid,'foid'=>$foid])}}" id="myForm">
                            @csrf
                            @foreach($userDatas as $userData)
                            <div class="formPic">
                                @if(empty($userData->upicture))
                                    <img class="headDivPic" src="{{ asset('pic/admin.png') }}" alt="">
                                @else
                                    <img class="headDivPic" src="{{ $userData->upicture}}" >
                                @endif                               
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
                                <img class="headDivPic" src="{{$userData->upicture}}" >
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
                                    <div class="new">
                                        @if(empty($forumNew->upicture))
                                            <img class="newpic" src="{{ asset('pic/admin.png') }}" alt="">
                                        @else
                                            <img class="newpic" src="{{$forumNew->upicture}}">
                                        @endif 
                                        <span class="newname">{{$forumNew->name}}</span>
                                        <br>
                                        <br>
                                        <span class="newtime">{{$forumNew->createtime}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
 
        <div class="abcc"></div>

@endsection