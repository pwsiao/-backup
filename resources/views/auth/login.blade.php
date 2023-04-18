<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>登入</title>
</head>
<body>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    <div>
        <a href="/BigProject/public"><div id="logo">與山同行LOGO</div></a>
    </div>
    <br><br><br><br><br>
    <div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="Logincontainer">
                <h1>登入</h1>
                <hr>
                <div id="inputcontianer">
                    <x-input-label for="email" :value="__('信箱：')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <br>
                    <x-input-label for="password" :value="__('密碼：')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <br><br>
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('記住我') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class=" text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('忘記密碼') }}
                            </a>
                        @endif
                    </div>

                    <br>
                    <button type="submit" class="loginbtn">登入</button>
                    <a href="{{ route('register') }}"><button type="button" class="registerbtn">註冊</button></a>  
                    <br>             
                </div>
            </div>
        </form>
    </div>
    <br><br>
    </body>

</html>








