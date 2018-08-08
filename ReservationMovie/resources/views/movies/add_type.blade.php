<?php $title = 'Add-Type-Movie'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')
    
    <div class="container">
        <div class="alert alert-primary mt-5 text-center">เพิ่มประเภทหนัง</div>
        <form method="post">
            <div class="form-group">
                {{ csrf_field() }}
                <div class="mt-2">ไอดีประเภทหนัง: </div>
                <div>
                    <input type="text" name="type_id" class="form-control">
                </div>
                <div>ชื่อประเภท: </div>
                <div>
                    <input type="text" name="type_name" class="form-control">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mt-3">
                </div>
            </div>
        </form>

    <!-- SHOW GENRE -->

    <table class="table">
    <thead>
        <tr>
        <th>ID</th>
        <th>GENRE</th>
        <th>MANAGE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Types as $Type)
        <tr>
            <td>{{ $Type->id }}</td>
            <td>{{ $Type->type_name }}</td>
            <td>
                <a href="{{ url('/movie/delete_AddType/'.$Type->id) }}" class="btn btn-danger" 
                                        onClick="return confirm('คุณต้องการลบใช่หรือไม่');">
                                        Delete
                                    </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table><hr>

    </div>

@endsection