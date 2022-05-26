<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        //Variable para seleccionar el archivo
        $imagen = $request->file('file');
        //genera un id unico para cada una de las imagenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Usamos intervention image para crearla
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
