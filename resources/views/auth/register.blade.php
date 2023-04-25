<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{asset('css/register.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/loginRegister.css')}}">

    <title>註冊</title>
</head>

<body>
    <div id="mainContent">
        <div id="logo"><a href="/"><img src="{{ asset('img/logo.jpg') }}"></a></div>

    <div id="mainForm">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mainInfoContainer">
            <h1>註冊</h1>
            <hr>
            <div id="inputcontianer">
                <div>
                    <x-input-label for="name" :value="__('暱稱：')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="請輸入想顯示在網站上的名稱"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="email" :value="__('電子信箱：')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="example@mail.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('密碼：')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="密碼長度至少為8個字元"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('確認密碼：')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="請再輸入一次密碼" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="registered flex items-center justify-end mt-4">
                    <a class="registeredLink underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('已經註冊過了?') }}
                    </a>
                </div>
                <div id="btns">
                    <button type="submit" class="registerbtn">註冊</button> 
                </div>
                <br>             
            </div>
        </div>
    </form>
    </div>
</body>

</html>






