<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/weather.css') }}">
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->

    <!-- <link rel="stylesheet" href="{{ asset('css/NavFooter.css') }}"> -->
    <title>與山同行</title>

</head>


<body>
    <div id="mainContent">
        <div id="logo">
            <a href="/"><img src="{{ asset('img/logo.jpg') }}" id="logoImg"></a>
            <div id="memberSection">
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            id="BtLogout">
                            {{ __('登出') }}
                        </x-dropdown-link>
                    </form>
                    <?php $user = Auth::user(); ?>
                    @if (empty($user->upicture))
                        <a href="{{ route('mbinfo') }}"><img src="{{ asset('pic/admin.png') }}" class="memberIcon"></a>
                    @else
                        <a href="{{ route('mbinfo') }}"><img src="{{ $user->upicture }}" class="memberIcon"></a>
                    @endif
                @else
                    <a href="{{ route('login') }}"><button id="BtLogin">登入/註冊</button></a>
                @endif
            </div>        
        </div>

        <div id="section1">
            <a href="{{ route('cphome') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/vehicle.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">拼車</h2>
                    <p class="featureIntro">想出發卻沒有交通工具，自己包車又好貴；準備開車出發，想找相同目的地的夥伴嗎？輸入出發地、出發日期、目的地，動動手指讓拼車功能幫你找人同行！</p>
                </div>
            </a>
            <a href="{{ route('feindex') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/chat.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">心得</h2>
                    <p class="featureIntro">想攻略哪座山，卻沒頭緒嗎？登山經驗、技巧、裝備、路線規劃⋯⋯等相關資訊分享都在這！快來分享心得、留言交流，讓登山的行前準備更輕鬆愉快！</p>
                </div>
            </a>
            <a href="{{ route('foqindex') }}" class="webFeature">
                <div class="pngDiv">
                    <img src="{{ asset('img/group.png') }}" class="homePng">
                </div>
                <div class="txt">
                    <h2 class="featureTitle">論壇</h2>
                    <p class="featureIntro">各種登山相關的話題討論區，不論是任何登山相關的疑難雜症，還是想認識新的登山友人，就讓論壇來幫你！發文交流、留言互動，一起享受登山健行吧。</p>
                </div>
            </a>
        </div>

        <div id="weather">
            <div class="row" style="width: 85%">
                <div class="col-md-12">
                    <form>
                        <span>請選擇 &nbsp;:</span>
                        <select name="" id="se">
                            <optgroup label="雪山主東">
                                <option value="102" selected>雪山主峰</option>
                                <option value="5">雪山東峰</option>
                            </optgroup>
                            <optgroup label="合歡群峰">
                                <option value="38">合歡北峰</option>
                                <option value="55">合歡東峰</option>
                            </optgroup>
                            <optgroup label="奇萊南華">
                                <option value="46">奇萊南峰</option>
                            </optgroup>
                            <optgroup label="嘉明湖步道">
                                <option value="84">向陽山</option>
                                <option value="81">三叉山</option>
                            </optgroup>
                            <optgroup label="玉山主峰">
                                <option value="121">玉山主峰</option>
                            </optgroup>
                            <optgroup label="北大武山">
                                <option value="96">北大武山</option>
                            </optgroup>
                            <optgroup label="南湖群峰">
                                <option value="2">南湖大山</option>
                                <option value="13">南湖東峰</option>
                                <option value="18">南湖北山</option>
                                <option value="20">審馬陣山</option>
                            </optgroup>
                            <optgroup label="大小霸尖山">
                                <option value="101">大霸尖山</option>
                                <option value="7">小霸尖山</option>
                                <option value="112">伊澤山</option>
                                <option value="100">審馬陣山</option>
                            </optgroup>
                            <optgroup label="南橫三星">
                                <option value="92">塔關山</option>
                                <option value="95">關山嶺山</option>
                                <option value="87">庫哈諾辛山</option>
                            </optgroup>
                        </select>
                        <button type="button" onclick=getTable() class="btn btn-outline-success">確定</button>
                    </form>
                </div>
                <div class="col-md-12 mt-4 d-flex justify-content-center">
                    <h1 id="title"></h1>
                </div>
                <div id="mes" style="text-align: center;">
                    <img src="{{ asset('img/icons8-spinner.gif') }}" alt="" style="height: 50px;"> fetching
                </div>
                <div class="col-md-12">
                    <div id="table1" class="tablesticky"></div>
                </div>
                <div class="col-md-12">資料來源:&nbsp;中央氣象局 &nbsp;&nbsp;&nbsp;&nbsp;更新頻率:&nbsp;每6小時</div>
            </div>
        </div>

        <div id="newFeel">
            <h2>最新心得</h2>
            <div class="sliderContainer">
                <div class="slider responsive">
                    @foreach ($feeldatas as $data)
                    <a href="{{ route('fedetail', ['id' => $data->fid]) }}">
                        <div class="card">
                            <img src=" {{ $data->fpicture }}" class="articlePic">
                            <h5>{{ $data->title }}</h5>
                            <p>作者：{{ $data->name }}</p>
                            <p>發表日期：{{ $data->date }}</p>
                            <div style="margin: 15px 0;">
                            </div>
                            {{-- <a href="{{ route('fedetail', ['id' => $data->fid]) }}">
                                <button>閱讀</button>
                            </a> --}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="newForum">
            <h2>最新討論</h2>
            <div class="sliderContainer">
                <div class="slider responsive">
                    @foreach ($forumdatas as $data)
                    <a href="{{ route('fodetail', ['sfid' => $data->sfid, 'foid' => $data->foid]) }}">
                        <div class="card">
                            <img src="{{ $data->fpicture }}" class="articlePic">
                            <h5>{{ $data->title }}</h5>
                            <p>作者：{{ $data->name }}</p>
                            <p>發表日期：{{ $data->date }}</p>
                            <div style="margin: 15px 0;">
                            </div>
                            {{-- <a href="{{ route('fodetail', ['sfid' => $data->sfid, 'foid' => $data->foid]) }}">
                                <button>閱讀</button>
                            </a> --}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- 輪播控制 -->
        <script src="{{ asset('js/index.js') }}"></script>
        <footer id="footer">
            <ul class="footerMenu">
                <li><a href="{{ route('cphome') }}">拼車</a></li>
                <li><a href="/feelIndex">心得</a></li>
                <li><a href="/forumIndex">論壇</a></li>
            </ul>
            <div id="left">Copyright © 2023 與山同行/Mountogether Rights Reserved.</div>
        </footer>
    </div>

    <script>
        $.ajax({
            url: "/weather",
            success: function (data) {
                $("#mes").hide()
                // var a = JSON.parse(data);
                var b = data.cwbopendata.dataset.locations.location

                getTable = function () {
                    let se1 = document.getElementById("se").value
                    document.getElementById("title").innerHTML = b[se1].locationName
                    let row1 = "<table><thead><tr><td class='t1'>日期</td>"
                    let row2 = "<tbody><tr><td class='t1'>時間</td>"
                    let row3 = "<tr><td class='t1'>溫度</td>"
                    let row4 = "<tr><td class='t1'>降雨機率</td>"
                    let row5 = "<tr><td class='t1'>風向</td>"
                    let row6 = "<tr><td class='t1'>風速</td>"
                    let row7 = "<tr><td rowspan=2 class='t1'>天氣狀況</td>"
                    let row8 = "<tr>"

                    let x = []
                    var date = b[se1].weatherElement[0].time[0].dataTime.toString().substring(0, 10)
                    for (let i = 0; i < 10; i++) {
                        if (b[se1].weatherElement[0].time[i].dataTime.toString().substring(0, 10) === date) {
                            x.push(1)
                        } else {
                            break
                        }
                    }
                    let y = x.length
                    let z = 6 - y
                    
                    row1 += `<td colspan =${y}>` + b[se1].weatherElement[0].time[0].dataTime.toString().substring(0, 10) + "</td>"
                    let row1_2 = "<td colspan=8>" + b[se1].weatherElement[0].time[y].dataTime.toString().substring(0, 10) + "</td>"
                    let row1_3 = "<td colspan=8>" + b[se1].weatherElement[0].time[y + 8].dataTime.toString().substring(0, 10) + "</td>"
                    let row1_4 = "<td colspan=8>" + b[se1].weatherElement[0].time[y + 16].dataTime.toString().substring(0, 10) + "</td>"
                    let row1_5 = `<td colspan =${z}>` + b[se1].weatherElement[0].time[29].dataTime.toString().substring(0, 10) + "</td>"
                    let col = `<colgroup><col span=${y + 1} style='background-color:white;'><col span=8 style='background-color:rgb(201, 238, 252);'>
                            <col span=8 style='background-color:white;'><col span=8 style='background-color:rgb(201, 238, 252);'></colgroup>`

                    for (let i = 0; i < 30; i++) {
                        row2 += "<td>" + b[se1].weatherElement[0].time[i].dataTime.toString().substring(11, 16) + "</td>"
                        row3 += "<td>" + b[se1].weatherElement[0].time[i].elementValue.value + "°C</td>"
                        row5 += "<td>" + b[se1].weatherElement[5].time[i].elementValue.value + "</td>"
                        row6 += "<td>" + b[se1].weatherElement[6].time[i].elementValue[0].value + "<span style='font-size:14px;'>m/s</span></td>"
                        row7 += "<td>" + b[se1].weatherElement[9].time[i].elementValue[0].value + "</td>"
                        var time = b[se1].weatherElement[0].time[i].dataTime.toString().substring(11, 16)
                        var wx2 = b[se1].weatherElement[9].time[i].elementValue[1].value
                        if (time == "00:00" || time == "03:00" || time == "21:00" || time == "18:00") {
                            row8 += "<td>" + `<img src="{{ asset('img/weathericon/${wx2}00-removebg-preview.png') }}">` + "</td>"
                        } else {
                            row8 += "<td>" + `<img src="{{ asset('img/weathericon/${wx2}-removebg-preview.png') }}">` + "</td>"
                        }
                    }

                    for (let i = 0; i < 15; i++) {
                        row4 += "<td colspan=2>" + b[se1].weatherElement[3].time[i].elementValue.value + "%</td>"
                    }

                    if (z <= 0) {
                        table1 = row1 + row1_2 + row1_3 + row1_4 + "</tr></thead>" + row2 + "</tr>" + row3 + "</tr>" +
                            row4 + row6 + row5 + row7 + row8 + "</tr></tbody>" + col + "</table>"
                    } else {
                        table1 = row1 + row1_2 + row1_3 + row1_4 + row1_5 + "</tr></thead>" + row2 + "</tr>" + row3 + "</tr>" +
                            row4 + row6 + row5 + row7 + row8 + "</tr></tbody>" + col + "</table>"
                    }

                    document.getElementById("table1").innerHTML = table1
                }

                getTable()
            }
        })
    </script>


</body>

</html>
