@extends('main')
 

@section('head')
<title>個人資料 | 與山同行</title>
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
                <label for="image" class="formLabel">
                    <span id="iconName">頭像：</span>
                </label>
                @if ($user->upicture != null)
                <img src="{{ $user->upicture }}" id="iconImg">
                @else
                <img src="{{asset('img/admin.png')}}" id="iconImg">
                @endif
                <input name="image" id="image" type="file" style="width: 200px;"><br />

                <label for="name" class="formLabel">
                    暱稱：
                </label>
                <input type="text" name="name" id="name" value="{{ $user->name }}"><br />

                <label for="birthday" class="formLabel">
                    生日：
                </label>
                <input type="date" name="birthday" id="birthday" value="{{ $user->birthday }}"><br />

                <label class="formLabel">
                    性別：
                </label>
                <label for="male"><input type="radio" name="sex" id="male" value="1" <?php echo ($user->sex == "1") ? " checked" : ""; ?>>男</label>
                <label for="female"><input type="radio" name="sex" id="female" value="2" <?php echo ($user->sex == "2") ? " checked" : ""; ?>>女</label><br />
                
                <label class="formLabel">
                    電子郵件：
                </label>
                {{ $user->email }}<br />

                <label for="about" class="formLabel">
                    關於我：<br />
                </label>
                <textarea name="about" id="about" rows="5">{{ $user->about }}</textarea><br />

                <button class="saveChange">儲存修改</button>
            </form>
            <hr />
            <form id="changePwd" method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <h2>修改密碼</h2>
                <label for="current_password" class="formLabel">
                    目前密碼：
                </label>
                <input type="password" name="current_password" id="current_password"><br />

                <label for="password" class="formLabel">
                    新密碼：
                </label>
                <input type="password" name="password" id="password"><br />

                <label for="password_confirmation" class="formLabel">
                    確認密碼：
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"><br />

                <button class="saveChange">變更密碼</button>
            </form>
        </div>

    </div>
</div>

@endsection