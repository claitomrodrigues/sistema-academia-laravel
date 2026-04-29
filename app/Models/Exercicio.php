<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $fillable = [
        'nome',
        'grupo_muscular',
    ];

    public function itensTreino()
    {
        return $this->hasMany(ItemTreino::class);
    }
}