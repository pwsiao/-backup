@extends('main')


@section('head')
    @foreach ($articles as $article)
        <title>{{ $article->title }} - 論壇討論串 | 與山同行</title>
    @endforeach

    <link rel="stylesheet" href="{{ asset('css/forumDetail.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection


@section('content')
    <div id="content-container">
        <div class="row">
            <div class="column1">
                <!-- 文章內容 -->
                <div id="content">
                    @if (isset($articles))
                        @foreach ($articles as $article)
                            <div class="author">
                                @if (empty($article->upicture))
                                    <img src="{{ asset('pic/admin.png') }}" alt="">
                                @else
                                    <img src="{{ $article->upicture }}">
                                @endif
                                <span>{{ $article->name }}</span>
                                @auth
                                    <a id="heartHref">
                                        <i class="bi bi-suit-heart-fill" id="heart"></i>
                                    </a>
                                @endauth
                            </div>
                            <div>
                                <h1>{{ $article->title }}</h1>
                                <p>{{ $article->date }}</p>
                            </div>
                            <div id="imgDiv">
                                <img src="{{ $article->fpicture }}">
                            </div>
                            <div id="artCon">{{ $article->content }}</div>
                        @endforeach
                    @endif
                </div>
                @auth
                    <script>
                        // 获取图标元素和链接元素
                        const heartIcon = document.getElementById('heart');
                        const heartHref = document.getElementById('heartHref');
                        const isRed = {!! json_encode($isRed) !!};
                        if (isRed.length > 0) {
                            heartIcon.style.color = '#d64045';
                        }

                        // 监听点击事件
                        heartIcon.addEventListener('click', () => {
                            event.preventDefault();

                            // 切换图标颜色
                            if (isRed.length > 0) {
                                //   heartIcon.classList.add('text-danger');

                                window.location.href = "{{ route('founsave', ['sfid' => $sfid, 'ftid' => $foid]) }}";
                                alert("取消收藏");
                            } else {
                                //   heartIcon.classList.remove('text-danger');
                                heartIcon.style.color = '#d64045';
                                window.location.href = "{{ route('fosave', ['sfid' => $sfid, 'ftid' => $foid]) }}";
                                alert("收藏成功");
                            }
                        });
                    </script>

                @endauth
                <!-- 留言紀錄 -->
                @if ($FCquestions == null)
                    <div id="mesHis">
                        <div class="noComment">
                            <p>還沒有人留言喔～</p>
                            <p>快來當頭香～</p>
                        </div>
                    </div>
                @else
                    <div id="mesHis">
                        @foreach ($FCquestions as $FCquestion)
                            <div class="headDiv">
                                <div class="headDivChi">
                                    @if (empty($FCquestion->upicture))
                                        <img class="headDivPic" src="{{ asset('pic/admin.png') }}" alt="">
                                    @else
                                        <img class="headDivPic" src="{{ $FCquestion->upicture }}">
                                    @endif
                                    <p>{{ $FCquestion->name }}</p>
                                    @if ($FCquestion->uid === $uid)
                                        <div class="icons">
                                            <a class="edit-btn" data-id="{{ $FCquestion->focid }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <span>|</span>
                                            <a href="{{ route('forumcomdelect', ['focid' => $FCquestion->focid]) }}"><i
                                                    class="bi bi-trash3"></i></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="headDivChi2">
                                    <div class="commentContent">{{ $FCquestion->content }}</div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            // 获取所有编辑按钮
                            var editButtons = document.querySelectorAll('.bi-pencil-square');
                            // 定义处理编辑按钮点击事件的函数
                            function handleEditButtonClick(button) {

                                var divToEdit = button.closest('.headDiv').querySelector('.headDivChi2');
                                var fcidd = button.closest('.edit-btn').dataset.id;
                                var text = divToEdit.innerText;
                                // console.log(text);
                                divToEdit.innerHTML = `
                                    <form action="{{ route('forumcomedit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="${fcidd}" name="focid">
                                        <textarea name="content" class="editComment" required>${text}</textarea>
                                        <input class="editbt" type="submit" value="-更新留言-">
                                    </form>
                                    `;
                            }
                            // 给每个编辑按钮绑定点击事件处理函数
                            editButtons.forEach((button) => {
                                button.addEventListener('click', () => {
                                    handleEditButtonClick(button);
                                });
                            });

                            function handleFormSubmit(event) {
                                // 防止表单提交
                                event.preventDefault();
                                // 获取表单元素和表单内容
                                var form = event.target;
                                var content = form.querySelector('textarea[name="content"]').value;
                                // 如果内容为空，弹出提示框
                                if (!content) {
                                    alert('请输入留言内容！');
                                } else {
                                    // 否则提交表单
                                    form.submit();
                                }
                            }
                        </script>

                    </div>
                @endif




                <!-- 留言 -->
                <div id="mes">
                    @if (Auth::check())
                        <form method="post" action="{{ route('forumcom', ['sfid' => $sfid, 'foid' => $foid]) }}"
                            id="myForm">
                            @csrf
                            @foreach ($userDatas as $userData)
                                <div class="formPic">
                                    @if (empty($userData->upicture))
                                        <img class="headDivPic" src="{{ asset('pic/admin.png') }}" alt="">
                                    @else
                                        <img class="headDivPic" src="{{ $userData->upicture }}">
                                    @endif
                                    <p>{{ $userData->name }} ></p>
                                </div>
                            @endforeach
                            <textarea name="forumcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                            <input type="submit" id="submitBtn" value="-送出-">
                        </form>
                        <script src="{{ asset('js/formtrim.js') }}"></script>
                    @else
                        <form method="post" action="#">
                            @csrf
                            @foreach ($userDatas as $userData)
                                <div class="formPic">
                                    <img class="headDivPic" src="{{ $userData->upicture }}">
                                    <p>{{ $userData->name }} ></p>
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
                    @foreach ($forumNews as $forumNew)
                        <a href="{{ route('fodetail', ['sfid' => $forumNew->sfid, 'foid' => $forumNew->foid]) }}"
                            class="linking2">
                            <div class="article2">
                                <div class="article2Con">
                                    <h3>{{ $forumNew->title }}</h3>
                                    <div class="new">
                                        @if (empty($forumNew->upicture))
                                            <img class="newpic" src="{{ asset('pic/admin.png') }}" alt="">
                                        @else
                                            <img class="newpic" src="{{ $forumNew->upicture }}">
                                        @endif
                                        <span class="newname">{{ $forumNew->name }}</span><br />
                                        <span class="newtime">{{ $forumNew->date }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </aside>
            </div>
        </div>
    </div>
@endsection
