<?php $title = 'Edit-Movie'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')

    <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="alert alert-primary mt-5">แก้ไขหนัง</div>

            <!-- API -->
            <form id="kuapi" action="{{url('/movie/kuapi')}}" method="get" enctype="multipart/form-data">
                {{ csrf_field() }}
                ค้นหาหนัง: <input type="text" name="seacrhAdd" class="form-control">
                <input type="submit" class="btn btn-primary btn-sm mt-1">
            </form><hr>
            <ul id="kuapi-result"></ul>

            <script type="text/javascript">
                var $result = $('#kuapi-result').html('');
                var $store = [];

                $('#kuapi').on('submit', function(e) {
                    e.preventDefault();
                    $.get('http://www.omdbapi.com/?apikey=e0fa6bac&s=' + e.target.seacrhAdd.value).done(function(resp) {
                        $result.html('');
                        $store.splice(0, $store.length);

                        resp.Search.forEach(function(value, key) {
                            $store.push(value);
                            $result.append(`
                            <li data-key="${key}" style="list-style-type: none;">
                                <img src="${value.Poster}" style="width: 80; height: 60px;/>
                                <span class="ml-2">${value.Title} (${value.Year})</span>
                                <span class="ml-2 badge badge-secondary">${value.Type}</span>
                                <!-- <input type="submit" value="เลือก" class="btn btn-primary btn-sm"> -->
                            </li>`);
                        });
                    });
                });

                $result.on('click', 'li', 'input', function(e) {
                    var $target = $(this);
                    var storeData = $store[$target.index()];
                    // $('#movie_picture').attr('type', 'hidden');
                    // $('#movie_picture2').attr('type', 'text');
                    $('#movie_picture2').val(storeData.Poster);
                    // var colorR = Math.floor((Math.random() * 256));
                    // var colorG = Math.floor((Math.random() * 256));
                    // var colorB = Math.floor((Math.random() * 256));
                    // $('#movie_picture').css("background-color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
                });
            </script>
            <!-- API -->

            <form id="postform" method="post" enctype="multipart/form-data" action="{{ url('/movie/create/'.$movie->id) }}">
                {{ method_field('PUT') }}
                <table class="table">
                    <tr>
                        {{ csrf_field() }}
                        <td>ชื่อหนัง: </td>
                        <td><input type="text" name="movie_name" value="{{ $movie->movie_name }}" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ชื่อผู้กำกับ: </td>
                        <td><input type="text" name="movie_code" value="{{ $movie->movie_code }}" class="form-control"></td>
                    </tr>
                    <!-- <tr>
                        <td>MovieRating: </td>
                        <td><input type="text" name="movie_rating"></td>
                    </tr> -->
                    <tr>
                        <td>รายละเอียดหนัง:</td>
                        <td>
                            <textarea name="movie_detail" rows="5" class="form-control" required>{{ $movie->movie_detail }}.</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ประเภท :</td>
                        <td>
                            <select name="movie_type[]" class="form-control" size="10" multiple>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if($type->match) selected @endif>{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>รูปภาพ: </td>
                        <td>
                        <input type="file" id="movie_picture" name="movie_picture" class="form-control-file">
                        <!-- <input type="hidden" id="movie_picture2" name="movie_picture2" class="form-control" style="background: #4CAF50;"> -->
                        </td>
                    </tr>
                    <tr>
                        <td></td><td><a href="javascript:history.back()" class="btn btn-danger mt-2 mx-2">กลับ</a><input type="submit" name="submit" value="แก้ไข" class="btn btn-primary mt-2"></td>
                    </tr>
                </table>
            </form>
            <br/>

@endsection