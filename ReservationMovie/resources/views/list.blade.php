<?php $title = 'List'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')

<div class="ImageMovieList">
<img src="{{asset('headerMovieList2.png')}}" alt="headerMovieList" width="100%">
<h2 class="TextMovieList"><span class="spanText">A Movie in the Park:<br/> <h1 style="margin-left: 8px;"><b>Kung Fu Panda</b></h1></span></h2>
</div>


<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div>
<!-- - -->

<table id="dataTable" class="table table-striped table-dark" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>IMAGE</th>
                <th>ลำดับ</th>
                <th>ชื่อหนัง</th>
                <th>ประเภท</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>
                    <input type="text" class="form-control" style="width: 80%" placeholder="ID">
                </th>
                <th>
                    <input type="text" class="form-control" style="width: 80%" placeholder="ชื่อหนัง">
                </th>
                <!-- <th>
                    <input type="text" class="form-control" style="width: 80%" placeholder="Code/Disc">
                </th> -->
                <th>
                    <select class="custom-select">
                        <option value="" selected>เลือกทุกประเภท</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($lists as $list)
                <tr>
                    <td>
                        <img src="{{ asset('/Movie_Picture/'.$list->movie_picture) }}" 
                            alt="{{ $list->movie_picture }}" width="100px" class="mb-2">
                    </td>
                    <td style="color: #FFF;">{{ $list->id }}</td>
                    <td><a href="{{ url('/search/'.$list->id) }}" style="color: #FFF;">{{ $list->movie_name }}</a></td>
                    <td>
                    @foreach ($list['type'] as $listType)
                        {{$listType->type_name}}
                    @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>

<!-- - -->

                </div>

                <!-- <br>{{ $lists->links('vendor.pagination.bootstrap-4') }}<br> -->
            </div>

        </div>

    </div><br/>

<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
    
        // DataTable
        var table = $('#dataTable').DataTable();
        
        // Apply the search
        table.columns().every( function () {
            var that = this;
            $('input', this.footer()).on('keyup', function () {
                if (that.search() !== this.value)
                    that.search( this.value ).draw();
            });

            $('select', this.footer()).on('change', function () {
                if (that.search() !== this.value)
                    that.search( this.value ).draw();
            });
        });
    } );
</script>

@endsection