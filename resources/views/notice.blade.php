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
        <div>    
            <h2>共乘通知</h2>
            @foreach($notice as $n)
                @if($n->type == 'App\Notifications\WannajoinNotice')
                    <a href="{{ route('mbcp')}}"><p>"{{ $n->data['joiner'] }}"{{ $n->data['message'] }}"{{ $n->data['cptitle'] }}"</p></a>
                @else
                    <p>沒有通知喔</p>
                @endif    
            @endforeach
        </div>
        <div>    
            <h2>留言通知</h2>
            @foreach($notice as $n)
                @if($n->type == 'App\Notifications\CpcommentNotice')
                    <a href="{{ route('cpinfo',['cpid'=>$n->data['cpid'] ])}}"><p>"{{ $n->data['someone']}}"{{ $n->data['message'] }}<{{ $n->data['cptitle'] }}>{{ $n->data['message2'] }} "{{ $n->data['comment'] }}"</p></a>
                @endif    
            @endforeach
        </div>
    </div>
</body>

</html>