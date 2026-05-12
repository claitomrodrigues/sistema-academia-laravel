<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\ItemTreino;
use App\Models\Plano;

class Treino extends Model
{
    protected $fillable = [
        'aluno_id',
        'plano_id',
        'tipo',
        'dias_semana',
        'personal',
        'status',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemTreino::class);
    }
}