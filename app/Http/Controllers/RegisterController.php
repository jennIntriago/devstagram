<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){

        //Modificar el request
        $request->request->add(['username' => Str::slug( $request->username)]);

        //Validación
        $this->validate($request, [
            'name' => ['required', 'max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => ['required', 'confirmed', 'min:6']

        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Atenticar un usuario
        //Se utiliza la funcion attempt para autenticar al user
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);
        //otro modo de autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar 
        return redirect()->route('posts.index', auth()->user()->username);   
    }
}
