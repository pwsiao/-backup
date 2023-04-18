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
    <title>首頁</title>

</head>


<body>
    @if(Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            id="BtLogin">
                {{ __('登出') }}
            </x-dropdown-link>
        </form>
    @else
        <a href="{{ route('login') }}"><button id="BtLogin">登入/註冊</button></a>
    @endif


    <div id="logo"><img src="{{ asset('img/logo-2.jpg') }}" alt="Logo Image"></div>
    <br><br><br><br>
    <div class="row">
        <a href="{{ route('feindex') }}">
            <div class="column">
                <div>
                    <img src="https://picsum.photos/420/230/?random=1" alt="John" style="width:100%">
                    <div style="margin: 24px 0;">
                    </div>
                    <a>心得</a>
                </div>
            </div>
        </a>
        <a href="{{ route('foindex') }}">
            <div class="column">
                <img src="https://picsum.photos/420/230/?random=1" alt="John" style="width:100%">
                <div style="margin: 24px 0;">
                </div>
                <a>論壇</a>
            </div>
        </a>
        <a href="{{ route('cphome') }}">
            <div class="column">
                <img src="https://picsum.photos/420/230/?random=1" alt="John" style="width:100%">
                <div style="margin: 24px 0;">
                </div>
                <a>拼車</a>
            </div>
        </a>
    </div>
    <br><br>
    <h1>最新心得</h1>
    <div class="sliderContainer">
        <div class="slider responsive">
        @foreach($feeldatas as $data)
            <div class="card">
                <img src="data:image/jpeg;base64,{{base64_encode($data->fpicture)}}">
                <h5>{{$data->title}}</h5>
                <p>作者：{{$data->name}}</p>
                <p>發表日期：{{$data->createtime}}</p>
                <div style="margin: 24px 0;">
                </div>
                <a href="{{ route('fedetail', ['id' => $data->fid]) }}">
                    <button>閱讀</button>
                </a>
            </div>
        @endforeach
        </div>
    </div>
    <br><br>
    <h1>最新討論</h1>
    <div class="sliderContainer">
        <div class="slider responsive">
        @foreach($forumdatas as $data)
            <div class="card">
                <img src="data:image/jpeg;base64,{{base64_encode($data->fpicture)}}">
                <h5>{{$data->title}}</h5>
                <p>作者：{{$data->name}}</p>
                <p>發表日期：{{$data->createtime}}</p>
                <div style="margin: 24px 0;">
                </div>
                <a href="{{ route('fodetail',['sfid'=>$data->sfid,'foid'=>$data->foid]) }}">
                    <button>閱讀</button>
                </a>
            </div>
        @endforeach
        </div>
    </div>
    <br><br>
    <!-- 輪播控制 -->
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>