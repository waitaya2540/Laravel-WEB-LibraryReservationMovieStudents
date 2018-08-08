<?php $title = 'Admin-Search'; ?>
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
                <div class="panel-heading alert alert-primary mt-5">Movie List</div>
                <div class="panel-body mx-3">

                    @foreach($adminSearchs as $adminSearch)
                        <label class="alert-link mx-4">ไอดี: {{$adminSearch['id']}} </label><br>
                        <img src="{{ asset('/Movie_Picture/'.$adminSearch['movie_picture']) }}" alt="{{ $adminSearch['movie_picture'] }}" width="10%" height="10%">
                         <br>ชื่อเรื่อง: {{$adminSearch['movie_name']}}  
                         <br>ผู้กำกับ: {{$adminSearch['movie_code']}} || 
                         เพิ่มในวันที่: {{$adminSearch['created_at']}}

                        <br><a href="/movie/delete/{{ $adminSearch['id'] }}" class="btn btn-danger mt-1">Delete</a>
                        <a href="{{ url('/movie/create/'.$adminSearch['id'].'/edit') }}" class="btn btn-warning mt-1">Edit</a> <hr/>
                    @endforeach
 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection