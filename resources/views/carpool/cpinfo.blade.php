@extends('main')


@section('head')
    <title>共乘資訊</title>
    <link rel="stylesheet" href="{{ asset('css/cpinfo.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection


@section('content')
    <div id="content-container">
        <div class="row">
            <div class="column1">
                <!-- 文章內容 -->
                <div id="content">
                    <div class="author">
                        @if (isset($cp->poster['upicture']))
                            <img src="{{ $cp->poster['upicture'] }}" alt="">
                        @else
                            <img src="{{ asset('pic/admin.png') }}" alt="">
                        @endif
                        <span>{{ $cp->poster['name'] }}</span>
                    </div>
                    <div>
                        <h1>{{ $cp->cptitle }}</h1>
                        <p>{{ $cp->createtime }}</p>
                    </div>
                    <div id="artCon">
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <h3>目的地 : <h3>
                                    </td>
                                    <td>{{ $cp->arrive }}</td>
                                </tr>
                                <tr>
                                    @if ($cp->value == 1)
                                        <td>我有車</td>
                                    @elseif($cp->value == 2)
                                        <td>找包車</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>
                                        <h3>出發日期 : </h3>
                                    </td>
                                    <td>{{ $cp->departdate }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>回程日期 : </h3>
                                    </td>
                                    <td>{{ $cp->returndate }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>出發地點 : </h3>
                                    </td>
                                    <td>{{ $cp->depart }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>內建人數 : </h3>
                                    </td>
                                    <td>{{ $cp->original }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>欲徵人數 : </h3>
                                    </td>
                                    <td>{{ $cp->hire }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>包車費用 : </h3>
                                    </td>
                                    <td>{{ $cp->cost }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="height: 50px;">
                                        <h3>備註 : </h3>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2" style="height: 50px;">{{ $cp->note }}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="height: 50px;"></div>
                    </div>

                </div>
                <!-- 參加鈕 -->
                    @if (strtotime($cp->departdate) > $today)
                        @if ($joiner < $cp->hire)
                            @if (Auth::check())
                                @if ($uid != $id)
                                    @if ($n1 == 0)
                                    <div id="content2">
                                        <form method="post" action="{{ route('cpjoin', ['cpid' => $cp->cpid]) }}">
                                            @csrf
                                            <input type="submit" id="joinbutton1" value="加入">
                                        </form>
                                    </div>
                                    @elseif($status == 0)
                                    <div id="content2">
                                        <div id="joinbutton2">確認中</div>
                                    </div>
                                    @elseif($status == 1)
                                    <div id="content2">
                                        <div id="joinbutton2">已加入</div>
                                    </div>
                                    @elseif($status == 2)
                                    <div id="content2">
                                        <div id="joinbutton2">被拒絕</div>
                                    </div>
                                    @endif
                                @else
                                    {{-- <div style="height: 100px"></div> --}}
                                @endif
                            @else
                            <div id="content2">
                                <a href="{{ route('login') }}" id="joinbutton2">加入</a>
                            </div>
                            @endif
                        @elseif(Auth::check() && $status == 1)
                        <div id="content2">
                            <div id="joinbutton2">已加入</div>
                        </div>
                        @else
                        <div id="content2">
                            <div id="joinbutton2">已徵滿</div>
                        </div>
                        @endif
                    @else
                    <div id="content2">
                        <div id="joinbutton2">已過期</div>
                    </div>
                    @endif
                <!-- 留言板 -->
                <div id="carpool-comment">
                    @if (isset($comments))
                        @foreach ($comments as $comment)
                            <div id="mesHis">
                                <div class="headDiv">
                                    <div class="headDivChi">
                                        @if (isset($comment->upicture))
                                            <img class="headDivPic" src="{{ $comment->upicture }}">
                                        @else
                                            <img class="headDivPic" src="{{ asset('pic/admin.png') }}">
                                        @endif
                                        <p>{{ $comment->name }}</p>
                                        @if ($comment->uid === Auth::id())
                                            <div class="icons">
                                                <form action="{{ route('cpcomdelete') }}" method="post"
                                                    onsubmit="return confirm('確定要刪除此留言嗎？')">
                                                    @csrf
                                                    <a class="edit-btn" data-id="{{ $comment->cpcid }}"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <span>|</span>
                                                    <input type="hidden" name="cpcid" value="{{ $comment->cpcid }}">
                                                    <button type="submit"
                                                        style="background-color: #d8ddcf ;border:none;"><i
                                                            class="bi bi-trash3"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="headDivChi2">
                                        <div class="commentContent">{{ $comment->content }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div id="mesHis">
                            <div class="headDiv">
                                <div class="headDivChi">
                                </div>
                                <div class="noComment">
                                    <p>還沒有人留言喔～</p>
                                    <p>快來當頭香～</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <script>
                        var editButtons = document.querySelectorAll('.bi-pencil-square');

                        function handleEditButtonClick(button) {
                            var divToEdit = button.closest('.headDiv').querySelector('.headDivChi2');
                            var cpcid = button.closest('.edit-btn').dataset.id;
                            var comment = divToEdit.innerText;
                            divToEdit.innerHTML = `
                            <form action="{{ route('cpcomedit') }}" method="POST">
                                @csrf
                                <textarea name="content" class="editComment" required>${comment}</textarea>
                                <input type="hidden" name="cpcid" value = ${cpcid} >
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
                    </script>




                    <!-- 留言框 -->
                    <div id="mes">
                        @if (Auth::check())
                            <form method="post" action="{{ route('cpcomment', ['cpid' => $cp->cpid]) }}" id="myForm">
                                @csrf
                                @foreach ($userDatas as $userData)
                                    <div class="formPic">
                                        @if (empty($userData->upicture) == false)
                                            <img class="headDivPic" src="{{ $userData->upicture }}">
                                        @else
                                            <img class="headDivPic" src="{{ asset('pic/admin.png') }}">
                                        @endif
                                        <p>{{ $userData->name }} ></p>
                                    </div>
                                @endforeach
                                <textarea name="cpcom" id="feelcom" cols="30" rows="10" placeholder="留言...."></textarea>
                                <input id="submitBtn" type="submit" value="-送出-">
                            </form>
                            <script src="{{ asset('js/formtrim.js') }}"></script>
                        @else
                            <textarea name="feelcom" id="" cols="30" rows="10" placeholder="你需要先登入才能留言喔～" disabled></textarea>
                            <input type="button" value="-送出-">
                        @endif
                    </div>
                </div>
            </div>
            <!-- 側邊攔 -->
            <aside class="column2">
                <h1>-最近揪共乘-</h1>
                @foreach ($cplist as $cp)
                <a href="{{ route('cpinfo', [$cp->cpid]) }}" class="linking2">
                    @if (strtotime($cp->departdate) > $today)
                        <div class="article2">
                            <div class="article2Con">
                                    <h3>{{ $cp->cptitle }}</h3>
                                <span>目的地：{{ $cp->arrive }}</span><br />
                                <span>出發日期：{{ $cp->departdate }}</span>
                            </div>
                        </div>
                    @endif
                </a>
                @endforeach
            </aside>

        </div>
    @endsection
