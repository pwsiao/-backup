<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/NavFooter.css')}}">
   
    @yield('head')

</head>

<body>
    <div id="container">
        <nav id="navbar">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('img/logo-2.jpg') }}">
                </a>
            </div>
            <ul class="menu">
                <li><a href="{{ route('cphome') }}">拼車</a></li>
                <li><a href="{{ route('feindex') }}">心得</a></li>
                <li><a href="{{ route('foqindex') }}">論壇</a></li>
                @if (Auth::check())
                    <?php $user = Auth::user(); ?>
                    @if(empty($user->upicture))
                        <li><a href="{{ route('mbinfo') }}"><img src="{{ asset('pic/admin.png') }}"></a></li>
                    @else
                        <li><a href="{{ route('mbinfo') }}"><img src="{{ $user->upicture }}" ></a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}"><img src="{{ asset('pic/admin.png') }}"></a></li>
                @endif
                

            </ul>
        </nav>

        <!-- navbar for mobile -->
        <nav id="mobileNavbar">
            <div class="mobileLogo"><a href="index.html"><img src="{{ asset('img/logo-2.jpg') }}"></a></div>
            <label id="hamburgerIcon" for="hamburgerInput">
                <i class="bi bi-list"></i>
            </label>
            <input type="checkbox" id="hamburgerInput">
            <ul class="menuForMobile">
                @if (Auth::check())
                <?php $user = Auth::user(); ?>
                @if(empty($user->upicture))
                    <li><a href="{{ route('mbinfo') }}"><img src="{{ asset('pic/admin.png') }}"></a></li>
                @else
                    <li><a href="{{ route('mbinfo') }}"><img src="{{ $user->upicture }}" ></a></li>
                @endif
            @else
                <li><a href="{{ route('login') }}"><img src="{{ asset('pic/admin.png') }}"></a></li>
            @endif
                <li><a href="{{ route('cphome') }}">拼車</a></li>
                <li><a href="{{ route('feindex') }}">心得</a></li>
                <li><a href="{{ route('foqindex') }}">論壇</a></li>
            </ul>
        </nav>

        @yield('content')

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