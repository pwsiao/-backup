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
            <h2>通知</h2>
            @if(count($notice) > 0)
                @foreach($notice as $n)
                    @if($n->type == 'App\Notifications\WannajoinNotice')
                        <span>[揪共乘] {{ $n->created_at}}</span><a href="{{ route('mbcp')}}">
                        <p>"{{ $n->data['joiner'] }}"{{ $n->data['message'] }}&#60;{{ $n->data['cptitle'] }}&#62;</p></a>
                    @elseif($n->type == 'App\Notifications\ConfirmJoinNotice')
                        <span>[共乘確認] {{ $n->created_at}}</span><a href="{{ route('mbcp')}}">
                        <p>"{{ $n->data['poster'] }}"{{ $n->data['message'] }}&#60;{{ $n->data['cptitle'] }}&#62;{{ $n->data['message2'] }}</p></a>
                    @elseif($n->type == 'App\Notifications\DeclineJoinNotice')
                        <span>[共乘確認] {{ $n->created_at}}</span><a href="{{ route('mbcp')}}">
                        <p>"{{ $n->data['poster'] }}"{{ $n->data['message'] }}&#60;{{ $n->data['cptitle'] }}&#62;{{ $n->data['message2'] }}</p></a>
                    @elseif($n->type == 'App\Notifications\CpcommentNotice')
                        @if ($n->notifiable_id != $n->data['uid'])
                            <span>[共乘留言] {{ $n->created_at}}</span><a href="{{ route('cpinfo',['cpid'=>$n->data['cpid'] ])}}">
                            <p>"{{ $n->data['someone']}}"{{ $n->data['message'] }} &#60; {{ $n->data['cptitle'] }} &#62; {{ $n->data['message2'] }} "{{ $n->data['comment'] }}"</p></a>
                        @endif
                    @elseif($n->type == 'App\Notifications\FeelCommentNotice')
                        @if ($n->notifiable_id != $n->data['uid'])
                            <span>[心得留言] {{ $n->created_at}}</span><a href="{{ route('fedetail',['id'=>$n->data['ftid'] ])}}">
                            <p>"{{ $n->data['someone']}}"{{ $n->data['message'] }} &#60; {{ $n->data['title'] }} &#62; {{ $n->data['message2'] }} "{{ $n->data['comment'] }}"</p></a>
                        @endif
                    @elseif($n->type == 'App\Notifications\ForumCommentNotice')
                        @if ($n->notifiable_id != $n->data['uid'])
                            <span>[論壇留言] {{ $n->created_at}}</span><a href="{{ route('fodetail',['sfid'=>$n->data['sfid'], 'foid'=>$n->data['foid'] ])}}">
                            <p>"{{ $n->data['someone']}}"{{ $n->data['message'] }} &#60; {{ $n->data['title'] }} &#62; {{ $n->data['message2'] }} "{{ $n->data['comment'] }}"</p></a>
                        @endif
                    @endif    
                @endforeach
            @else
                <p>沒有通知喔</p>
            @endif
        </div>
    </div>
</body>

</html>