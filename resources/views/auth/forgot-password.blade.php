<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>忘記密碼</title>
</head>

<body>
    <div>
        <a href="/BigProject/public"><div id="logo">與山同行LOGO</div></a>
    </div>
    <br><br><br><br><br><br>
    <div>
    <!-- Session Status -->


    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="registercontainer">
            <h1>忘記密碼</h1>
            <hr>
            <div id="inputcontianer">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('信箱：')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('告訴我們您的電子郵件地址') }}
                    <br>
                    {{ __('我們就會寄送一封密碼重設連結給您。') }}
                </div>
                <br>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <br>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="registerbtn">
                        {{ __('發送連結') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>

</body>

</html>







