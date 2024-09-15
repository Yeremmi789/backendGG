<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeria_Juegos extends Model
{
    use HasFactory;

    public function juegos():BelongsTo{
        return $this->belongsTo(Juegos::class, 'juego_id');
    }
}
