<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){

    }
    public function login(){
        return View('login');
    }
    public function store(Request $req){
        
    }
    public function edit($id){

    }
    public function update(Request $req, $id){

    }
    public function delete($id){

    }
}
