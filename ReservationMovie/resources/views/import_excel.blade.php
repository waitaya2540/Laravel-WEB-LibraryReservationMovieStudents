<?php $title = 'importExcel'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')
    <div class="container">

        <div class="alert alert-success mt-5">
            <center><h1>Import Excel</h1></center>
        </div>

        <form action="{{ route('contact.import') }}" method="post" enctype="multipart/form-data" class="mt-5">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="file" name="import_movie" class="form-conreol-file">
            <input type="submit" value="Import" class="btn btn-primary">
        </form>

        <div>
            <a href="javascript:history.back()" class="btn btn-danger mt-5">กลับ</a>
        </div>
    </div>

@endsection