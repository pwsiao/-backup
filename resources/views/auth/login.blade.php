<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/loginRegister.css')}}">
    <title>登入</title>
</head>
<body>
    <div id="mainContent">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div id="logo"><a href="/"><img src="{{ asset('img/logo.jpg') }}"></a></div>

        <div id="mainForm">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="mainInfoContainer">
                        <h1>登入</h1>
                        <hr>
                        <div id="inputcontianer">
                            <x-input-label for="email" :value="__('電子信箱：')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="example@mail.com"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <br>
                            <x-input-label for="password" :value="__('密碼：')" />
                            <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <br>
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-cente rememberMe">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('記住我') }}</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="forgotPwd text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('忘記密碼') }}
                                    </a>
                                @endif
                            </div>
        
                            <div id="btns">
                                <button type="button" class="registerbtn" onclick="location.href='{{ route('register') }}'">註冊</button> 
                                <button type="submit" class="loginbtn">登入</button>    
                            </div>
                        </div>
                    </div>
                </form>        
        </div>
    </div>
    </body>

</html>







