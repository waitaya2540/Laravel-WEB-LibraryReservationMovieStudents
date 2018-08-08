<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Type;
use App\OnAir;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(){
        // dd(Movie::with('onAir')->get()->toArray());
        return view('index')->with('onAir', OnAir::with('movie')->first());
    }

    public function search($id){
        return view('movies.movie_search', ['Searchs'=>Movie::where('id', $id)->with('type')->get()]);
        // return view('movie_search', [Movie::where('id', $id)->with('onAir')->get()]);
    }

    public function MovieList(){
        $types = Type::all();
        $lists = Movie::with('type')->paginate(999999);
        return view('list', compact('lists', 'types'));
    }

    public function navSearch(Request $request) {
        // Movie::select('movie_name as value', 'movie_id as data')->get();
        $movie = Movie::select('movie_name as value', 'id as data', 'movie_picture as pic')
                ->where('movie_name', 'like', '%' . $request->input('query') . '%')
                ->get()->toArray();
        return response()->json([
            'query' => 'Unit',
            'suggestions' => $movie,
        ]);
    }

    public function storeSearch(Request $request){
        $data = new Movie();
        $data->movie_name = $request->input('search')->where('value');
        return response()->json($data, 200);
    }

    public function delete_TimeOnAir($id){
        OnAir::where('id', $id)->delete();
        return redirect()->route('index');
    }

}
