<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTreino extends Model
{
    protected $fillable = [
        'treino_id',
        'exercicio_id',
        'series',
        'reps',
        'carga',
    ];

    public function treino()
    {
        return $this->belongsTo(Treino::class);
    }

    public function exercicio()
    {
        return $this->belongsTo(Exercicio::class);
    }
}