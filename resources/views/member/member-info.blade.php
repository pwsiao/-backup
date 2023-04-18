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

        <div class="mainContent">
            <form id="info">
                <h2>個人資料</h2>
                <p id="icon">
                    <span id="iconName">頭像：</span>
                    <img src="{{asset('img/1.jpeg')}}" id="iconImg">
                    <input type="file" name="icon"><br />
                </p>
                <p>
                    暱稱：
                    <input type="text" name="userName" value="王小明"><br />
                </p>
                <p>
                    生日：
                    <input type="date" name="birthday" value="2019-10-10"><br />
                </p>
                <p>
                    性別：
                    <label for="male"><input type="radio" name="gender" id="male" value="male" checked>男</label>
                    <label for="female"><input type="radio" name="gender" id="female" value="female">女</label>
                    <label for="other"><input type="radio" name="gender" id="other" value="other">其他</label><br />
                </p>
                <p>
                    電子郵件：
                    abc123@gmail.com<br />
                </p>
                <p>
                    關於我：<br />
                    <textarea name="" id="" cols="30" rows="10">早安</textarea><br />
                </p>
                <button type="button">儲存修改</button>
            </form>
            <hr />
            <form id="changePwd">
                <h2>修改密碼</h2>
                <p>
                    目前密碼：
                    <input type="password" name="currentPwd"><br />
                </p>
                <p>
                    新密碼：
                    <input type="password" name="newPwd"><br />
                </p>
                <p>
                    確認密碼：
                    <input type="password" name="confirmPwd"><br />
                </p>
                <button type="button">儲存修改</button>
            </form>
        </div>

    </div>
</div>

@endsection