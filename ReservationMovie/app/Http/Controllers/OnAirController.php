<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Type;
use App\OnAir;
use Illuminate\Http\Request;

class OnAirController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
 
     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */

    public function index(){
        // dd(OnAir::orderBy('start_at')->take(1)->with('movie')->first());
        return view('movies.on_air', ['onAiRs' => OnAir::orderBy('start_at')->take(1)->with('movie')->first()]);
        
    }

    public function store(Request $request) {

        $request->validate([
            'movie_id'  => 'required',
            'start_at'  => 'required',
            'ended_at'  => 'required',
        ], [
            'movie_id.required' => 'กรุณากรอกชื่อไอดีหนัง.',
            'start_at.required' => 'กรุณาใส่เวลาเริ่มฉาย.',
            'ended_at.required' => 'กรุณาใส่เวลาฉายจบ.',
        ]);

        $on_air = new OnAir();
        $on_air->movie_id = $request->input('movie_id');
        $on_air->start_at = $request->input('start_at');
        $on_air->ended_at = $request->input('ended_at');

        $on_air->save();
        
        return redirect()->route('movie.on_air');
    }

    public function delete($id) {
        OnAir::where('id', $id)->delete();
        return redirect()->route('movie.on_air');
    }

    public function update(Request $request, $id) {
        
        $movie = OnAir::find($id);
        
        $movie->start_at = $request->input('start_at');
        $movie->ended_at = $request->input('ended_at');

        $movie->update();

        return redirect()->route('movie.on_air');
        
    }

    public function edit($id) {
        
        $movie = OnAir::find($id);
        return view('movies.edit_onAir', compact('movie'));
        
    }
}
