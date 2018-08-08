<?php $title = 'Edit-OnAir'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading alert alert-warning mt-5">แก้ไขคิวที่จอง</div>

                <div class="panel-body">

                    <form method="post" enctype="multipart/form-data" action="{{ url('/movie/on_air/'.$movie->id) }}">
                        {{ method_field('PUT') }}
                        <table>
                            <tr>
                                {{ csrf_field() }}
                                <td>เวลาเริ่มฉาย: </td>
                                <td><input type="datetime-local" name="start_at"  class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>เวลาฉายจบ:</td>
                                <td><input type="datetime-local" name="ended_at" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td><a href="javascript:history.back()" class="btn btn-primary mt-3 mx-2">กลับ</a><input type="submit" name="submit" value="แก้ไข" class="btn btn-warning mt-3"></td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


