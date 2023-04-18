<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li><a href="{{route('cphome')}}">拼車</a></li>
                <li><a href="/forumIndex">論壇</a></li>
                <li><a href="/feelIndex">心得</a></li>
                @if (Auth::check())
                <?php
                    $user = Auth::user();
                    $imgData = base64_encode($user->upicture);
                ?>
                <li><a href="{{ route('mbinfo') }}"><img src="data:image/jpeg;base64,{{ $imgData }}" ></a></li>
                @else
                <li><a href="{{ route('login') }}"><img src="{{ asset('pic/admin.png') }}" alt=""></a></li>
                @endif

            </ul>
        </nav>

        <!-- navbar for mobile -->
        <nav id="mobileNavbar">
            <div class="mobileLogo"><a href="index.html"><img src="./img/logo.jpg"></a></div>
            <label id="hamburgerIcon" for="hamburgerInput">
                <i class="bi bi-list"></i>
            </label>
            <input type="checkbox" id="hamburgerInput">
            <ul class="menuForMobile">
                <li><a href="index.html">拼車</a></li>
                <li><a href="all-memo.html">論壇</a></li>
                <li><a href="map.html">心得</a></li>
                <li><a href="what-to-eat.html">個人頁面</a></li>
            </ul>
        </nav>

        @yield('content')

        <footer id="footer">
            <div id="left">Copyright © 2023 the-sponger.com Rights Reserved.</div>
            <div id="links">
                <a href="https://the-sponger.com/"><i class="bi bi-house"></i></a>&nbsp;&nbsp;&nbsp;
                <a href="https://www.instagram.com/the.sponger/"><i class="bi bi-instagram"></i></a>&nbsp;&nbsp;&nbsp;
                <a href="mailto:thesponger91@gmail.com"><i class="bi bi-envelope"></i></a>
            </div>
        </footer>
    </div>
</body>

</html>