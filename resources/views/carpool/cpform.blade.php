@extends('main')


@section('head')
<title>發起共乘</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('css/carpoolcp.css')}}">
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

@endsection


@section('content')
<div id="content-container">
    <h1 id="carpool-title">我要揪共乘</h1>
    <div id="carpoolform-container">
        <img src="{{asset('img/carpool.jpg')}}" alt="">
        <form action="{{route('cpform')}}" method="post">
            @csrf
            <div style="display: flex; justify-content: center;">
                <table>
                    <tr>
                        <td><label for="title1">標題名稱 : </label></td>
                        <td><input type="text" id="title1" name="title1" required></td>
                    </tr>
                    <tr>
                        <td><input type="radio" id="radio1" name="radio1" value="1" required>我有車</td>
                        <td><input type="radio" id="radio2" name="radio1" value="2">找包車</td>
                    </tr>
                    <tr>
                        <td><label for="arrive1">目的地 : </label></td>
                        <td><input type="text" id="arrive1" name="arrive1" required></td>
                    </tr>
                    <tr>
                        <td><label for="departdate1">出發日期 : </label></td>
                        <td><input type="date" id="departdate1" name="departdate1" required
                                    max="{{$max}}" min="{{$min}}" ></td>
                    </tr>
                    <tr>
                        <td><label for="returndate1">回程日期 : </label></td>
                        <td><input type="date" id="returndate1" name="returndate1" required
                                    max="{{$max}}" min="{{$min}}" > </td>
                    </tr>
                    <tr>
                        <td><label for="depart1">出發地點 : </label></td>
                        <td><input type="text" id="depart1" name="depart1" required></td>
                    </tr>
                    <tr>
                        <td><label for="original1">內建人數 : </label></td>
                        <td><input type="number" min=1 max=6 id="original1" name="original1" required></td>
                    </tr>
                    <tr>
                        <td><label for="hire1">欲徵人數 : </label></td>
                        <td><input type="number" min=1 max=6 id="hire1" name="hire1" required></td>
                    </tr>
                    <tr>
                        <td><label for="cost1">費用 : </label></td>
                        <td><input type="text" id="cost1" name="cost1" required></td>
                    </tr>
                    <tr>
                        <td><label for="note1">備註 : </label></td>
                        <td><textarea id="note1" name="note1" style="width: 200px;height: 100px;"></textarea>
                        </td>
                    </tr>
                    <!-- <tr>
                            <td><a href="./carpool_home.html"><input type="button" value="取消"></a> </td>
                            <td><input type="submit" value="送出"></td>
                        </tr> -->
                </table>
            </div>
            <td><a href="{{route('cphome')}}"><input type="button" value="取消"></a> </td>
            <td><input type="submit" value="送出"></td>

        </form>
    </div>
</div>

<div style="height: 200px;"></div>
@endsection