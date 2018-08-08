<?php $title = 'KU-On-Air'; ?>
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
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading mt-5 text-center" 
                    style="background: #ffc107; padding: 15px; border: 5px solid #ffc107; color: #000; width: 100%;">กำหนดคิวฉายหนัง</div>

                <div class="panel-body">


                        @if ($errors->any())
                            <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                            </div>
                        @endif

                        <span class="badge badge-pill badge-dark mt-2" style="font-size: 15px;">เพิ่มคิว:</span><br>

                        <!-- Search -->
                        <form method="get" action="{{ url('/movie/search') }}" class="mt-2 mb-2">
                            {{ csrf_field() }}
                                <input type="text" class="form-control typeahead mx-5" placeholder="ค้นหาไอดีหนัง" name="search" id="autoselect" style="width: 90%;"/>
                            </a>
                        </form>

                        <form method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            ไอดีหนัง: <input type="text" id="movie_id" name="movie_id" class="form-control"><br/>
                            เวลาเริ่มฉาย: <input type="datetime-local" name="start_at" class="form-control"><br/>
                            เวลาฉายจบ: <input type="datetime-local" name="ended_at" class="form-control"><br/>

                            <input type="submit" value="กำหนดคิว" class="btn btn-success mb-5"><br/>

                        <!-- Real-Time -->
                        <center>
                            <span id="txt" class="btn btn-dark" style="font-size: 30px; padding: 10px;"></span>
                        </center>

                        </form><br/><div class="alert-link">หนังที่กำลังจะฉาย: </div><br/><br/>
                        @if(empty($onAiRs))
                            <center class="alert-link">ไม่มีหนังที่ฉายอยู่ในขณะนี้</center><br/><br/>
                        @else
                        <center>
                            <div><h3><label>เรื่อง: {{ $onAiRs->movie->movie_name }} <br>ID: {{ $onAiRs->movie_id }}</label></h3></div><br>
                            <img src="{{ asset('/Movie_Picture/'.$onAiRs->movie->movie_picture) }}" alt="{{ $onAiRs->movie->movie_picture }}" width="50%"><br>
                            <div class="mt-3">เวลาเริ่มฉาย: {{ $onAiRs->start_at }} || เวลาฉายจบ: {{ $onAiRs->ended_at }}</div><br>
                            <div>
                            <a href="{{url("/movie/delete_onAir/$onAiRs->id")}}" onClick="return confirm('คุณต้องการลบคิวนี้ใช่หรือไม่');"
                                class="btn btn-danger">Delete</a>
                            <a class="btn btn-warning" 
                                href="{{ url("/movie/on_air/$onAiRs->id/edit_onAir") }}">Edit</a></div><hr>
                            </div>
                        </center>
                        @endif

                        


                </div>
            </div>
        </div>
    </div>
</div>

<!-- JQ Autocomplete -->
<script type="text/javascript">
    $('#autoselect').autocomplete({
        serviceUrl: '{{ url('/navSearch') }}',

        formatResult: function(suggestion, currentValue) {
            // dd(suggestion.value);
            return `
                <label class="btn btn-dark mt-1">ID: ${suggestion.data}</label>
                <img src="{{ url('/Movie_Picture/${suggestion.pic}') }}" width="50px">
                <label>${suggestion.value}</label>
            `;
        },
        onSelect: function (suggestion) {
            $('#movie_id').val(suggestion.data);
        }
    });
</script>

@endsection
