<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Protege el endpoint con el user autenticado
    public function __construct(){
        
        $this->middleware('auth');
    }
    public function index(User $user){

        // dd($user->username);
        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }
}
