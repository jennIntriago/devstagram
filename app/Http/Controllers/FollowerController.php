<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(User $user){
        //$user = usuario que estamos siguiendo
        //$request = usuario que va a seguir al $user

        //utilizamos attach ya que usamos users como pivote o la misma tabla como este caso y tenemos una relacion --followers--
        //cuando llamamos a la relacion Followers sin parecentes accedemos a la informacion, cuando lo hacemos con parentesis llamamos a la definicion de la funcion como tal
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
} 
