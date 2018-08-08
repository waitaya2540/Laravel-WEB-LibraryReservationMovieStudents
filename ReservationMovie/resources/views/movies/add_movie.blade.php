<?php $title = 'Create'; ?>
@extends('layouts.navIndex')

<!-- Section Real Time -->
@section('Real-Time')
    <?php $RealTime = ""; ?>
@endsection

@section('content')

<script>
$(document).ready(function(){
    $("#bSearch").click(function(){
        $("#innerSearch").html(" <b>Appended text</b>.");
    });
});
</script>

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

            <div class="mt-5 mb-3" style="background: blue; padding: 15px; border: 5px solid blue; color: #FFF; width: 100%;"> เพิ่มรายการหนัง </div>
            
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
                                <input type="submit" value="เลือก" class="btn btn-primary btn-sm">
                            </li>`);
                        });
                    });
                });

                $result.on('click', 'li', 'input', function(e) {
                    var $target = $(this);
                    var storeData = $store[$target.index()];
                    $('#movie_picture').attr('type', 'hidden');
                    $('#movie_picture2').attr('type', 'text');
                    $('#movie_name').val(storeData.Title);
                    $('#movie_picture2').val(storeData.Poster);
                    // var colorR = Math.floor((Math.random() * 256));
                    // var colorG = Math.floor((Math.random() * 256));
                    // var colorB = Math.floor((Math.random() * 256));
                    // $('#movie_picture').css("background-color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
                });
            </script>

            <form id="postform" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        {{ csrf_field() }}
                        <td>ชื่อหนัง: </td>
                        <td><input type="text" id="movie_name" name="movie_name" class="form-control" placeholder="ชื่อหนังเรื่องนี้"></td>
                    </tr>
                    <tr>
                        <td>Code/Disc: </td>
                        <td><input type="text" id="movie_code" name="movie_code" class="form-control" placeholder="Code/Disc"></td>
                    </tr>
                    <!-- <tr>
                        <td>MovieRating: </td>
                        <td><input type="text" name="movie_rating"></td>
                    </tr> -->
                    <tr>
                        <td for="exampleFormControlTextarea1">รายละเอียดหนัง:</td>
                        <td>
                            <textarea id="movie_detail" name="movie_detail" class="form-control" id="exampleFormControlTextarea1" rows="3" 
                                placeholder="คำอธิบายเกี่ยวกับหนังเรื่องนี้"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>รูปภาพ: </td>
                        <td>
                            <input type="file" id="movie_picture" name="movie_picture" class="form-control-file">
                            <input type="hidden" id="movie_picture2" name="movie_picture2" class="form-control" style="background: #4CAF50;">
                        </td>
                    </tr>
                    <tr>
                        <td>ประเภทหนัง: </td>
                        <td>
                            <select id="movie_type" name="movie_type[]" class="form-control" multiple>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="เพิ่ม" class="btn btn-success"></td>
                    </tr>

                </table>
            </form>

            <!-- <script type="text/javascript">
                $('#postform').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData();
                    var $movie_name = $('#movie_name').val();
                    var $movie_code = $('#movie_code').val();
                    var $movie_detail = $('#movie_detail').val();
                    var $movie_picture = $('#movie_picture').val();
                    var $movie_type = $('#movie_type').val();

                    formData.append('movie_name', $movie_name);
                    formData.append('movie_code', $movie_code);
                    formData.append('movie_detail', $movie_detail);

                    if ($movie_picture) {
                        formData.append('movie_picture', $movie_picture);
                    }

                    formData.append('movie_type', $movie_type);

                    var $url = $('#movie_picture2').val();
                    if ($url) {
                        $.get($url).done(function(resp) {
                            formData.append('movie_picture2', new Blob(resp, {type:'image/jpeg'}));
                            $.ajax({
                                url: location.href,
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false
                            }).done(function(data) {
                                console.log(data);
                            });
                        });
                    } else {
                        $.ajax({
                            url: '/',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false
                        }).done(function(data) {
                            console.log(data);
                        });
                    }
                });
            </script> -->

            <br/>

            <!-- <form method="get" action="{{ url('/movie/search') }}" class="text-center">
                {{ csrf_field() }}
                ค้นหาหนัง: <input type="text" name="keyWord">
                <input type="submit" value="Search" class="btn btn-primary">
            </form> -->
                        <table id="dataTableAddMovie" class="table table-striped table-dark" cellspacing="0" width="100%">
                            <thead style="background: rgb(218, 193, 15);" >
                                <tr>
                                <th>Image</th>
                                <th>ID</th>
                                <th>ชื่อหนัง</th>
                                <th>Code/Disc</th>
                                <th>ประเภท</th>
                                <th>จัดการหนัง</th>
                                </tr>
                            </thead>
                            
                        <tbody>
                        @foreach($JTypes as $JType)
                            <tr>
                            <th>
                                <img src="{{ asset('/Movie_Picture/'.$JType->movie_picture) }}" 
                                    alt="{{ $JType->movie_picture }}" width="100px" class="mb-2">
                            </th>
                            <td>{{ $JType->id }}</td>
                            <td>{{ $JType->movie_name }}</td>
                            <td>{{ $JType->movie_code }}</td>
                            <td>
                                <label>
                                    {{ $JType->type->implode('type_name', ',') }}
                                </label>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ url('/movie/delete/'.$JType->id) }}" class="btn btn-danger" 
                                        onClick="return confirm('คุณต้องการลบหนังเรื่องนี้ใช่หรือไม่');">
                                        Delete
                                    </a>
                                    <a href="{{ url('/movie/create/'.$JType->id.'/edit') }}" class="btn btn-warning">
                                        Edit
                                    </a>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table><br/>
                        <!-- - -->
@endsection

</body>
</html>
