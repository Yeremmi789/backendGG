<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cesta extends Model
{
    use HasFactory;

    // Relación: una cesta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function juegos()
    {
        return $this->belongsTo(Juegos::class);
    }

    // Relación: muchos a muchos con productos (usando una tabla pivote)
    // public function juegos()
    // {
    //     return $this->belongsToMany(Juegos::class, 'cesta_productos')
    //                 ->withPivot('cantidad', 'precio_unitario')
    //                 ->withTimestamps();
    // }
}
