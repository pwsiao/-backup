@extends('main')


@section('head')
<title>心得發表</title>
    <link rel="stylesheet" href="{{ asset('css/feelMessage.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js'></script>

@endsection


@section('content')
<div id="content-container">
            <br><br>
            <h1>分享心得</h1>
            <div id="FormContainer">
                <form method="post" action="{{ route('feelmes',['uid'=>$uid])}}" enctype="multipart/form-data" id="myForm">
                    @csrf
                    選擇封面：<br>
                    <p></p>
                    <input type="file" id="photo-upload" name="pic" accept="image/*" required>
                    <div id="preview"></div>
                    <script src="{{asset('js/mesCanva.js')}}"></script>
                    <hr>
                    <input type="text" placeholder="輸入標題" name="title" id="title" minlength="5" required>
                    <br>
                    <textarea placeholder="輸入內容" name="content" id="textarea" minlength="10" required></textarea>
                    <br><br>
                    <hr>
                    <div id="bt">
                        <button type="submit" value="1" name="btValue">發布</button>
                        <button type="submit" value="0" name="btValue">儲存</button>
                        <!-- <input type="submit" value="儲存"> -->
                        <!-- <input type="submit" value="儲存" onclick="changeAction()"> -->
                    </div>
                </form>

                <!-- <script>
                    function changeAction(){
                            document.getElementById('myForm').action = "/BigProject/public/feelMesSaved/{{$uid}}";
                    }
                
                </script> -->
            </div>
            <br><br>
        </div>

@endsection