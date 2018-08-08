<?php

//หน้า แรก(index) ส่วนของการแสดงผลหนัง
Route::get('/', 'IndexController@index')->name('index');
// Route::get('/search', 'IndexController@search');
Route::get('/search/{id}', 'IndexController@search');

//Search AutoComplete
Route::get('/navSearch', 'IndexController@navSearch');
Route::post('/navSearch', 'IndexController@storeSearch');

Route::get('/list', 'IndexController@MovieList');

Route::get('/delete_TimeOnAir/{id}', 'IndexController@delete_TimeOnAir');

// Import Excel
Route::get('/getImport', 'ExcelController@getImport');
Route::post('/postImport', 'ExcelController@postImport')->name('contact.import');

Route::group(['prefix' => 'movie'], function() {

    // Add Type Movie
    Route::get('/addtype', 'MovieController@addtype')->name('movie.addtype');
    Route::post('/addtype', 'MovieController@addtypeStore');

    // DELETE Type Movie
    Route::get('/delete_AddType/{id}', 'MovieController@addtypeDelete');

    //ส่งตัวแปร JTypes ไปยังหน้า movies.add_movie เพื่อทำการ query ตาราง movies ใน DataBase
    Route::get('/create', 'MovieController@create')->name('movie.create');
    //บันทึกข้อมูลการเพิ่มหนังลงDatabase
    Route::post('/create', 'MovieController@store');
    //API OMDB
    Route::get('/kuapi', 'MovieController@apiAddStore');

    //หน้าลบข้อมูลในDatabase ของAdd Movie ของตาราง movies
    Route::get('/delete/{id}', 'MovieController@delete');

    //แก้ไขชื่อหรือรายละเอียดหนัง และ ทำการอัพเดทตัวที่แก้ไข
    Route::get('/create/{id}/edit', 'MovieController@edit');
    Route::put('/create/{id}', 'MovieController@update');

    //ค้นหารายการหนังที่ เพิ่มลงในDatabase
    Route::get('/search', 'MovieController@scopeSearch');

    //เพิ่มคิวลง Database ตาราง on_airs โดยถ้าจะquery จะใช้ตัวแปร onAiRs ในการloopข้อมูล
    Route::get('/on_air', 'OnAirController@index')->name('movie.on_air');
    Route::post('/on_air', 'OnAirController@store');

    //ลบข้อมูลการจองคิว
    Route::get('/delete_onAir/{id}', 'OnAirController@delete');

    //แก้ไขวันเวลาคิวหนัง และ ทำการอัพเดทลงDatabase
    Route::get('/on_air/{id}/edit_onAir', 'OnAirController@edit');
    Route::put('/on_air/{id}', 'OnAirController@update');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





