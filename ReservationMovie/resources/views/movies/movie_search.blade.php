<?php $title = 'KU-List'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading alert alert-success mt-5">Movie List</div>
                <div class="panel-body">
                
                    <ul style="list-style-type: none;">
                        <li>
                            @foreach($Searchs as $Search)
                                <center><img src="{{ asset('/Movie_Picture/'.$Search->movie_picture) }}" alt="{{ $Search->movie_picture }}" 
                                     width="50%"></center><br>
                                <label class="alert-link mt-3">เรื่อง:</label> {{ $Search->movie_name }}<br/>
                                <label class="alert-link mt-1">รายละเอียด:</label> {{ $Search->movie_detail }}<br>
                                @foreach($Search['type'] as $SearchType)
                                    <label>ประเภท: </label>
                                        @php 
                                            $type_char = $SearchType->movie_type;
                                            switch ($type_char) {
                                                case 1:
                                                    echo "Action";
                                                    break;
                                                case 2:
                                                    echo "Adventure";
                                                    break;
                                                case 3:
                                                    echo "Drama";
                                                    break;
                                                case 4:
                                                    echo "Sci-Fi";
                                                    break;
                                                case 5:
                                                    echo "Comedy";
                                                    break;
                                                case 6:
                                                    echo "Documentaries";
                                                    break;
                                            }
                                        @endphp
                                @endforeach
                                <br/>
                                <label class="alert-link">Code/Disc:</label> {{ $Search->movie_code }}<br>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a href="{{url('/list')}}" class="btn btn-primary mb-3"> กลับ </a>
</div>

@endsection