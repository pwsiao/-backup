@extends('main')

@section('head')

<title>共乘首頁</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/carpoolcp.css')}}">
    <link rel="stylesheet" href="{{asset('css/cphome.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
    <script src="{{asset('js/calendar.js')}}"></script>
@endsection

@php
    class Events {
        public $title;
        public $date;
        public $cpid;
        public function __construct($title, $date, $cpid) {
            $this->title = $title;
            $this->date = $date;
            $this->url = route('cpinfo',['cpid'=>$cpid]);
        }
    }

    $a =[];
    foreach($searchresult as $c){
    $event = new Events($c->cptitle, $c->departdate, $c->cpid);
    array_push($a,$event);
    }
    $objstring = json_encode($a);

@endphp


@section('content')

    <!-- 行事曆 -->
    <script>

        $(document).ready(function () {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            /*  className colors
            
            className: default(transparent), important(red), chill(pink), success(green), info(blue)
            
            */


            /* initialize the external events
            -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
            -----------------------------------------------------------------*/

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    // center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',

                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd',    // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d',  // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                // select: function(start, end, allDay) {
                // 	var title = prompt('Event Title:');
                // 	if (title) {
                // 		calendar.fullCalendar('renderEvent',
                // 			{
                // 				title: title,
                // 				start: start,
                // 				end: end,
                // 				allDay: allDay
                // 			},
                // 			true // make the event "stick"
                // 		);
                // 	}
                // 	calendar.fullCalendar('unselect');
                // },
                // droppable: true, // this allows things to be dropped onto the calendar !!!
                // drop: function(date, allDay) { // this function is called when something is dropped

                // 	// retrieve the dropped element's stored Event Object
                // 	var originalEventObject = $(this).data('eventObject');

                // 	// we need to copy it, so that multiple events don't have a reference to the same object
                // 	var copiedEventObject = $.extend({}, originalEventObject);

                // 	// assign it the date that was reported
                // 	copiedEventObject.start = date;
                // 	copiedEventObject.allDay = allDay;

                // 	// render the event on the calendar
                // 	// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                // 	$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // 	// is the "remove after drop" checkbox checked?
                // 	if ($('#drop-remove').is(':checked')) {
                // 		// if so, remove the element from the "Draggable Events" list
                // 		$(this).remove();
                // 	}

                // },

                events: <?php echo $objstring ?>
                //  [
                //     {
                //         "title": 'All Day Event',
                //         "start": new Date(y, m, 1)
                //     },
                //     {
                //         title: 'All Day Event',
                //         start: new Date(y, m, d, 10, 30),
                //         allDay: false,
                //         className: 'important'
                        // url: 'https://ccp.cloudaccess.net/aff.php?aff=5188',

                //     },
               
                // ],

                
                
            });


        });

    </script>


    <div id="content-container">
        <br>
        <h1 id="carpool-title">拼車</h1>
        <div id="carpool-link">
            @if(Auth::check())
                <a href="{{ route('cpform') }}">我要揪共乘</a>
            @else
                <a href="{{ route('login') }}">我要揪共乘</a>
            @endif
        </div>
        <div>
            <form class="example" action="{{ route('cphome') }}">
                <input type="text" placeholder="輸入關鍵字" name="search" id="search-input" value="{{$search}}">
                <button type="submit" id="searchbt">搜索</button>
            </form>
        </div>
        <div id="carpool-tabs-container">
            <div style="width: 80%;">
                <!-- Tab首列 -->
                <button class="tablink" onclick="openPage('carpool-calendar', this)" id="defaultOpen">出行月曆</button>
                <button class="tablink" onclick="openPage('carpool-list', this)">出行列表</button>
                <!-- Tab內容 -->
                <div id="carpool-calendar" class="tabcontent">
                        <div style="height: 30px;"></div>
                        <div style="display: flex; justify-content: center;">
                            <div id='wrap' >
                                <div id='calendar'></div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                        <div style="height: 50px;"></div>

                </div>

                <div id="carpool-list" class="tabcontent" style="text-align: center;">
                @if(count($searchresult) > 0)    
                    @foreach($searchresult as $cp)
                        <a href="{{route('cpinfo',[ 'cpid'=>$cp->cpid ] )}}">
                            <div class="carpool-list2">
                                <span>{{$cp->departdate}}</span>
                                <span>{{$cp->cptitle}}</span>
                                @if(isset($cp->upicture))
                                <img src="{{$cp->upicture}}" alt="">
                                @else
                                <img src="{{asset('pic/admin.png')}}" alt="">
                                @endif
                                
                                @foreach($cplist as $c)
                                    @if($cp->createtime == $c->createtime)
                                        @if(isset($c->joiner))
                                            @if($cp->hire > $c->joiner)
                                            <span>{{$c->joiner}}/{{$cp->hire}}</span>
                                            @elseif($cp->hire == $c->joiner)
                                            <span>已徵滿</span>
                                            @endif
                                        @else
                                        <span>0/{{$cp->hire}}</span>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </a>
                    @endforeach
                @else
                    <p style="font-size: 30px;">查無相關資料</p>
                @endif  
                </div>

            </div>
        </div>
    </div>

        <!-- Tab切換  -->
        <script>
            function openPage(pageName, elmnt, color) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "#B1BBA0";
                }
                document.getElementById(pageName).style.display = "block";
                elmnt.style.backgroundColor = "#D8DDCF";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();

        </script>


@endsection

