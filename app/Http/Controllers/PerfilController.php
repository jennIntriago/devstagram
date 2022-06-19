<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){
        // dd("Guardando post");
         //Modificar el request
        $request->request->add(['username' => Str::slug( $request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'. auth()->user()->id, 'min:3', 'max:20', 'not_in:editar-perfil'],
        ]);
        
    }
}
