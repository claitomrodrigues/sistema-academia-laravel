<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    protected $fillable = [
        'aluno_id',
        'tipo',
        'status',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemTreino::class);
    }
}