<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/NavFooter.css') }}"> -->
    <title>與山同行</title>

</head>


<body>
    <div id="mainContent">
        <div id="logo">
            <a href="/"><img src="{{ asset('img/logo.jpg') }}" id="logoImg"></a>
            <div id="memberSection">
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            id="BtLogout">
                            {{ __('登出') }}
                        </x-dropdown-link>
                    </form>
                    <?php $user = Auth::user(); ?>
                    @if (empty($user->upicture))
                        <a href="{{ route('mbinfo') }}"><img src="{{ asset('pic/admin.png') }}" class="memberIcon"></a>
                    @else
                        <a href="{{ route('mbinfo') }}"><img src="{{ $user->upicture }}" class="memberIcon"></a>
                    @endif
                @else
                    <a href="{{ route('login') }}"><button id="BtLogin">登入/註冊</button></a>
                @endif
            </div>        
        </div>

        <div id="section1">
            <a href="{{ route('cphome') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/vehicle.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">拼車</h2>
                    <p class="featureIntro">想出發卻沒有交通工具，自己包車又好貴；準備開車出發，想找相同目的地的夥伴嗎？輸入出發地、出發日期、目的地，動動手指讓拼車功能幫你找人同行！</p>
                </div>
            </a>
            <a href="{{ route('feindex') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/chat.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">心得</h2>
                    <p class="featureIntro">想攻略哪座山，卻沒頭緒嗎？登山經驗、技巧、裝備、路線規劃⋯⋯等相關資訊分享都在這！快來分享心得、留言交流，讓登山的行前準備更輕鬆愉快！</p>
                </div>
            </a>
            <a href="{{ route('foqindex') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/group.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">論壇</h2>
                    <p class="featureIntro">各種登山相關的話題討論區，不論是任何登山相關的疑難雜症，還是想認識新的登山友人，就讓論壇來幫你！發文交流、留言互動，一起享受登山健行吧。</p>
                </div>
            </a>
        </div>

        <div id="newFeel">
            <h2>最新心得</h2>
            <div class="sliderContainer">
                <div class="slider responsive">
                    @foreach ($feeldatas as $data)
                    <a href="{{ route('fedetail', ['id' => $data->fid]) }}">
                        <div class="card">
                            <img src=" {{ $data->fpicture }}" class="articlePic">
                            <h5>{{ $data->title }}</h5>
                            <p>作者：{{ $data->name }}</p>
                            <p>發表日期：{{ $data->date }}</p>
                            <div style="margin: 15px 0;">
                            </div>
                            {{-- <a href="{{ route('fedetail', ['id' => $data->fid]) }}">
                                <button>閱讀</button>
                            </a> --}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="newForum">
            <h2>最新討論</h2>
            <div class="sliderContainer">
                <div class="slider responsive">
                    @foreach ($forumdatas as $data)
                    <a href="{{ route('fodetail', ['sfid' => $data->sfid, 'foid' => $data->foid]) }}">
                        <div class="card">
                            <img src="{{ $data->fpicture }}" class="articlePic">
                            <h5>{{ $data->title }}</h5>
                            <p>作者：{{ $data->name }}</p>
                            <p>發表日期：{{ $data->date }}</p>
                            <div style="margin: 15px 0;">
                            </div>
                            {{-- <a href="{{ route('fodetail', ['sfid' => $data->sfid, 'foid' => $data->foid]) }}">
                                <button>閱讀</button>
                            </a> --}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- 輪播控制 -->
        <script src="{{ asset('js/index.js') }}"></script>
        <footer id="footer">
            <ul class="footerMenu">
                <li><a href="{{ route('cphome') }}">拼車</a></li>
                <li><a href="/feelIndex">心得</a></li>
                <li><a href="/forumIndex">論壇</a></li>
            </ul>
            <div id="left">Copyright © 2023 與山同行/Mountogether Rights Reserved.</div>
        </footer>
    </div>


</body>

</html>
