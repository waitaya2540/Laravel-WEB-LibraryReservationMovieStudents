<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Movie;
use Excel;

class ExcelController extends Controller
{
    public function getImport(){
        return view('import_excel');
    }
    public function postImport(Request $r){
        // dd($r->hasFile('import_movie'));
        if($r->hasFile('import_movie')) {
            $path = $r->file('import_movie')->getRealPath();
            $data = Excel::selectSheetsByIndex(0)->load($path, function($reader){})->get();

            // if (!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    if ( ! empty($value->movie_code) && ! empty($value->movie_name)) {
                        try {
                            $contact = new Movie();
                            $contact->movie_code = $value->movie_code;
                            $contact->movie_name = $value->movie_name;
                            $contact->movie_picture = '';
                            $contact->movie_detail = '';
                            $contact->save();
                        } catch (\Exception $e) {

                        }
                    }
                }
            // }
        }
        return back();
    }
}
