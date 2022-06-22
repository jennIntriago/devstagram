<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Usas invoke en lugar de index porque es un solo metodo que vas a utilizar
    public function __construct(){
        $this->middleware('auth');
    }
    public function __invoke(){
        // Obtener a quienes seguimos
        //toArray lo convierte a un arreglo y muestra la informacion
        //puck trae ciertos campos
        //lastes te trae los registros en forma DESC
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        return view('home', [
            'posts' => $posts,

        ]);
    }
}
