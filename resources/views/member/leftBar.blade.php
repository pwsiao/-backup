<section class="leftBarSection">
    <div id="leftBar">
        <ul>
            <li><a href="{{route('mbinfo')}}">個人資料</a></li>
            <li><a href="{{route('mbcp')}}">拼車/揪團紀錄</a></li>
            <li><a href="{{route('mbfeel')}}">心得</a></li>
            <li><a href="{{route('mbforum')}}">論壇</a></li>
            <li><a href="{{route('mbsave')}}">收藏</a></li>
        </ul>
    </div>

    <div id="mobileLeftBar">
        <ul>
            <li><a href="{{route('mbinfo')}}">個人<br />資料</a></li>
            <li><a href="{{route('mbcp')}}">拼車/<br />揪團<br />紀錄</a></li>
            <li><a href="{{route('mbfeel')}}">心得</a></li>
            <li><a href="{{route('mbforum')}}">論壇</a></li>
            <li><a href="{{route('mbsave')}}">收藏</a></li>
        </ul>
    </div>

    <form method="post" action="{{ route('logout')}}">
        @csrf
        <button id="logoutBtn">登出</button>
    </form>
</section>