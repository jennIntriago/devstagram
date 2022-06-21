<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //Fillable son los datos que esperamos que el usuarios nos de
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relaciones
    public function posts(){
        //One to Many
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers(){
        //como te estas saliendo de las convenciones de laravel, debes especificar que tabla y que campos haras la relacion
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        return $this->followers->contains($user->id);
    }
    //Almacenar los que seguimos


}
