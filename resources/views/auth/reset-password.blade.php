<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/loginRegister.css')}}">
    <title>重設密碼</title>
</head>

<body>
  <div id="mainContent">
  <div id="logo"><a href="/"><img src="{{ asset('img/logo.jpg') }}"></a></div>

  <div id="mainForm">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <div class="mainInfoContainer">
            <h1>重設密碼</h1>
            <hr>
            <div id="inputcontianer">
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('信箱：')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('密碼：')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('確認密碼：')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div id="btns">
                  <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="forgotSubmit">
                        {{ __('重設密碼') }}
                    </x-primary-button>
                </div>
                </div>
            </div>
        </div>

    </form>
  </div>
</body>

</html>
    
