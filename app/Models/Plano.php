<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'descricao',
        'periodo',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}