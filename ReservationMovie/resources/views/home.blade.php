<?php $title = 'Admin'; ?>
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
                <div class="panel-heading mt-5" style="background: #ff0000ba; padding: 15px; border: 5px solid #ff000000; color: #FFF; width: 100%;">Admin Status</div>

                <div class="panel-body mt-3">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <b>สวัสดีคุณ: {{ Auth::user()->name }}</b><br/>
                    <b>Email: </b>{{ Auth::user()->email }}<br/><br/>
                    <h6 class="alert-link">Kasetsart University - Library Movie</h6>
                     Kasetsart University Chalermphrakiat Sakon Nakhon Province Campus!<br/><br/>
                    <a href="{{url('/')}}" class="btn btn-warning">หนักหลัก</a>
                    <a href="{{url('/movie/create')}}" class="btn btn-warning">เพิ่มรายการหนัง</a>
                    <a href="{{url('/movie/on_air')}}" class="btn btn-warning">กำหนดคิวฉายหนัง</a>
                    <a href="{{url('/movie/addtype')}}" class="btn btn-warning">เพิ่มประเภทหนัง</a>
                    <a href="{{url('getImport')}}" class="btn btn-warning">ImportExcel</a>

                    <!-- Logout -->
                    <li class="btn btn-danger">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="color: #FFF;">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    </li>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
