@extends('main')
 

@section('head')
<title>個人頁面</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/member-all.css')}}">
<link rel="stylesheet" href="{{asset('css/member-info.css')}}">
<script type="text/javascript" src="{{asset('js/member-all.js')}}"></script>


@endsection


@section('content')
<div id="content-container">
    <div id="pageHeader">
        <h1>個人資料</h1>
    </div>

    <div id="mainContent">

        @include('member.leftBar')


        <div class="pageContent">
            <form id="info" method="POST" action="{{ route('mbinfo.update') }}" enctype="multipart/form-data">
            @csrf
                <h2>個人資料</h2>
                <p id="icon">
                    <span id="iconName">頭像：</span>
                    @if ($user->upicture != null)
                    {{-- <img src="data:image/jpeg;base64,{{ base64_encode($user->image) }}" id="iconImg"> --}}
                    <img src="{{ $user->upicture }}" id="iconImg">
                    @else
                    <img src="{{asset('img/admin.png')}}" id="iconImg">
                    @endif
                    <input name="image" type="file"><br />
                </p>
                <p>
                    暱稱：
                    <input type="text" name="name" value="{{ $user->name }}"><br />
                </p>
                <p>
                    生日：
                    <input type="date" name="birthday" value="{{ $user->birthday }}"><br />
                </p>
                <p>
                    性別：
                    <label for="male"><input type="radio" name="sex" id="male" value="1" <?php echo ($user->sex == "1") ? " checked" : ""; ?>>男</label>
                    <label for="female"><input type="radio" name="sex" id="female" value="2" <?php echo ($user->sex == "2") ? " checked" : ""; ?>>女</label>
                </p>
                <p>
                    電子郵件：
                    {{ $user->email }}<br />
                </p>
                <p>
                    關於我：<br />
                    {{-- <input type="text" name="about" id="" value="{{ $user->about }}"> --}}
                    <textarea name="about" id="" cols="30" rows="10">{{ $user->about }}</textarea><br />
                </p>
                <button>儲存修改</button>
            </form>
            <hr />
            <form id="changePwd" method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <h2>修改密碼</h2>
                <p>
                    目前密碼：
                    <input type="password" name="current_password"><br />
                </p>
                <p>
                    新密碼：
                    <input type="password" name="password"><br />
                </p>
                <p>
                    確認密碼：
                    <input type="password" name="password_confirmation"><br />
                </p>
                <button>儲存修改</button>
            </form>
        </div>

    </div>
</div>

@endsection