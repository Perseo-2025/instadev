<?php

namespace App\Models;

use App\Models\like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    /* Creando la relacion o Eloquent (un usuario puede tener multiples posts) */
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}

