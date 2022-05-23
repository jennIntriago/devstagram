<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //Protege el endpoint con el user autenticado
    public function __construct(){
        
        $this->middleware('auth');
    }
    public function index(){

        return view('dashboard');
    }
}
