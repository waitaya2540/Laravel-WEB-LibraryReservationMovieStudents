<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class addMovieController extends Controller
{
    function addMovie(Request $req)
    {
        $movie_name = $req->input('movie_name');
        $movie_code = $req->input('movie_code');
        $movie_picture = $req->input('movie_picture');
        // $movie_rating = $req->input('movie_rating');
        $ldate = Carbon::now();

        // $data = array('movie_name'=>$movie_name, 
        //                 'movie_director'=>$movie_director, 
        //                 'movie_picture'=>$movie_picture, 
        //                 'movie_rating'=>$movie_rating,
        //                 'created_at'=>$ldate,
        //                 'updated_at'=>$ldate);

        // DB::table('movies')->insert($data);

        


        echo "SuccessFull";
    }
}
