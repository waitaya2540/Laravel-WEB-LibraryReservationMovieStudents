<?php $title = 'Kasetsart University - Library Movie'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = "startTime()"; ?>
@endsection

@section('content')

    <!-- Real-Time -->
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>

<div class="container">

    <!-- row1 -->
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center mt-3 mb-2"><a href="http://www.csc.ku.ac.th"><img 
                    src="{{ asset('LogoKU.png') }}" alt="KU" width="350px"></a></div>
                <div class="panel-body">

                    <!-- Real-Time -->
                    <br/><center>
                        <img src="{{ asset('languageblack48.png') }}" width="80px" class="mb-4"><span id="txt" class="mb-5" style="font-size: 50px;"></span>
                    </center> 
                </div>
            </div>
        </div>
    </div>
        <!-- row2 -->
        <div class="row align-items-center" align="center">
            ...<br/><br/><br/>
        </div>

        <!-- row3 -->


                @if(isset($onAir))
                      @if (time() >= strtotime($onAir->start_at) AND time() <= strtotime($onAir->ended_at))
                        <div class="row justify-content-center position-absolute fixed-bottom" style="background-color: green;">
                                @if(!empty($onAir->movie->movie_picture))
                                <div class="col-5" style="background-color: green;" align="right"><br/>
                                <img src="{{ asset('/Movie_Picture/' . $onAir->movie->movie_picture) }}" 
                                    alt="{{$onAir->movie->movie_picture}}" width="150px" style="border: 5px solid #212516;">
                                @else
                                <div class="col-4" style="background-color: green;" align="right"><br/>
                                @endif <br/><br/>
                            </div>
                            <div class="col-7" style="background-color: green;">
                                <br/><b>ชื่อหนังที่กำลังฉาย <br/> {{$onAir->movie->movie_name}}</b><br/>
                                <br/><label>เริ่มฉาย: </label>{{$onAir->start_at}}
                                <label>ฉายเสร็จ: </label>{{$onAir->ended_at}}<br/>
                            </div>
                        </div>
                    @else
                            <div class="row justify-content-center position-absolute fixed-bottom" style="background-color: green;">
                                <div class="col-8 mt-4 mb-2" 
                                    style="background-color: orange; padding: 5px; border: 5px solid orange; color: #FFF; text-align: center;">
                                        <h3>เปิดให้จองคิวได้ในอีก 10 นาที</h3>
                                </div>
                                <div class="col-12 mt-4 mb-4">
                                    <center><b>ชื่อหนังที่ฉายจบ: {{$onAir->movie->movie_name}}</b></center>
                                </div>
                            </div>
                            <?php $nextDelete = strtotime($onAir->ended_at) + (1 * 1 * 10 * 60); ?>
                            @if($nextDelete <= time())
                                <?php echo '<script>location.href="' . url('/delete_TimeOnAir', $onAir->id) . '"</script>' ?>
                            @endif
                    @endif
                @else
                    <div class="row justify-content-center position-absolute fixed-bottom" style="background-color: green;">
                        <div class="col-7 mt-2" style="color: #FFF;">
                            หนังที่ฉายในขณะนี้: 
                        </div>
                        <div class="col-6 mt-3 mb-3" style="background-color: red; padding: 5px; border: 5px solid red; color: #FFF; text-align: center;">
                            <marquee>ไม่มีหนังที่ฉายอยู่ในขณะนี้ นิสิตหรือบุคคลากรทุกท่านสามารถจองคิวหนังได้แล้วในขณะนี้ที่ <b>ห้องสมุด มหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตเฉลิมพระเกียรติ จังหวัดสกลนคร</b></marquee>
                        </div>
                    </div>
                @endif

    </div>

</div>
@endsection

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>