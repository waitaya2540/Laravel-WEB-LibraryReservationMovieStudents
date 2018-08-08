<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Type;
use App\OnAir;
use Image;
use Illuminate\Http\Request;

class MovieController extends Controller
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

    public function index() {
        dd(Movie::with('type')->get()->toArray());
    }

    public function create() {
        $types = Type::all();
        $JTypes = Movie::with('type')->get();
        return view('movies.add_movie', compact('JTypes', 'types'));
    }

    public function apiAddStore(Request $request) {
        // dd($request->input('seacrhAdd'));
        $seacrhAdd = $request->input('seacrhAdd');
        return view('movies.add_movie', ['addApis' => $seacrhAdd]);
    }

    public function addtype() {
        return view('movies.add_type', ['Types' => Type::get()]);
    }

    public function addtypeStore(Request $request) {

        $type = new Type();
        $type->id           = $request->input('type_id');
        $type->type_name    = $request->input('type_name');

        $type->save();

        return redirect()->route('movie.addtype');
    }

    public function addtypeDelete($id) {

        Type::where('id', $id)->delete();
        
        return redirect()->route('movie.addtype');
        
    }

    public function store(Request $r) {
        $r->validate([
            'movie_name'        => 'required',
            'movie_code'        => 'required',
            // 'movie_picture'     => 'required',
            // 'movie_picture2'    => 'required',            
            'movie_detail'      => 'required',
            'movie_type'        => 'required',
        ], [
            'movie_name.required'             => 'กรุณากรอกชื่อหนัง.',
            'movie_code.required'             => 'กรุณากรอกรหัสแผ่น.',
            // 'movie_picture.required'          => 'กรุณาใส่ภาพประกอบ.',
            'movie_detail.required'           => 'กรุณาใส่รายละเอียดหนัง',
            'movie_type.required'             => 'กรุณาใส่ประเภทหนัง',
        ]);

        $movie = new Movie();
        $movie->movie_name = $r->input('movie_name');
        $movie->movie_code = $r->input('movie_code');
        $movie->movie_detail = $r->input('movie_detail');

        if ($r->hasFile('movie_picture')) {
            $picture = $r->file('movie_picture');
            if ($picture->isValid()) {
                $hashName = hash('sha256', time() . $picture->hashName()) . '.' . $picture->clientExtension();
                $picture->storeAs('/Movie_Picture', $hashName, 'upload');
                $movie->movie_picture = $hashName;
            }
        } elseif ($r->has('movie_picture2')) {
            // $picture = $r->file('movie_picture2');
            // if ($picture->isValid()) {
            //     $hashName = hash('sha256', time() . $picture->hashName()) . '.' . $picture->clientExtension();
            //     $picture->storeAs('/Movie_Picture', $hashName, 'upload');
            //     $movie->movie_picture = $hashName;
            // }
            $content = file_get_contents($r->input('movie_picture2'));
            if ( ! empty($content)) {
                $hashName = hash('sha256', time() . $r->input('movie_picture2')) . '.jpg';
                file_put_contents(public_path('Movie_Picture/' . $hashName), $content);
                $movie->movie_picture = $hashName;
            }
        } else{
            $movie->movie_picture = '';
        }

        $movie->save();

        // $movie_roles = App\Movie::roles();

        $movie->type()->sync($r->input('movie_type'));

        // $type = new Type();

        // $type->movie_id = $movie->id;
        // $type->movie_type = $r->input('movie_type');

        // $type->save();

        return redirect()->route('movie.create');
    }

    public function edit($id) {
        $types = Type::all();
        $movie = Movie::with('type')->find($id);

        $keys = $movie->type->pluck('id')->toArray();

        foreach($types as $type) {
            if (in_array($type->id, $keys)) {
                $type->match = true;
            } else {
                $type->match = false;
            }
        }

        // dd($movie);
        return view('movies.edit', compact('movie', 'types'));

    }

    public function update(Request $r, $id) {

        $movie = Movie::find($id);

        $movie->movie_name      = $r->input('movie_name');
        $movie->movie_code      = $r->input('movie_code');
        $movie->movie_detail    = $r->input('movie_detail');

        // dd($r->input('movie_type'));

        if ($r->hasFile('movie_picture')) {
            $picture = $r->file('movie_picture');
            if ($picture->isValid()) {
                $hashName = hash('sha256', time() . $picture->hashName()) . '.' . $picture->clientExtension();
                $picture->storeAs('/Movie_Picture', $hashName, 'upload');
                $movie->movie_picture = $hashName;
            }
        }

        $movie->type()->sync($r->input('movie_type'));

        // Movie Type
        // if( ! empty($r->input('movie_type'))) {
        //     $movie->movie_type = $r->input('movie_type');

            // $movie = Movie::where('type', $r->input('movie_type'))->get();
            // if( ! empty($movie)) {
            //     $movieType = Movie::find($id)->type;
            //     $movieType->movie_type = $r->input('movie_type');
            //     $movieType->update();
            // } else {
            //         $type = new Type();
            
            //         $type->movie_id = $movie->id;
            //         $type->movie_type = $r->input('movie_type');
            
            //         $type->save();
            //     }
        // } else {
        //     $movie->movie_type = '';
        // }

        $movie->save();

        return redirect()->route('movie.create');

    }

    public function delete($id) {
        $movie = Movie::find($id);

        if ( ! empty($movie->movie_picture)){
            unlink(public_path('Movie_Picture/' . $movie->movie_picture));
        }

        $movie->type()->sync([]);
        $movie->onAir()->delete();
        $movie->delete();

        return redirect()->route('movie.create');
    }

    public function scopeSearch(Request $r){

        $keyWord = $r->input('keyWord');

        if($keyWord != '') {
        return view('movies.adminSearch', ['adminSearchs'=>Movie::where('movie_name', 'LIKE', '%'.$keyWord.'%')
            ->orWhere('movie_code', 'LIKE', '%'.$keyWord.'%')
            ->get()->toArray()]);
        }
    }

}
