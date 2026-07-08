<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    protected $table = 'presencas';

    protected $fillable = [
        'aluno_id',
        'data_presenca',
        'horario',
        'observacao',
    ];

    protected $casts = [
        'data_presenca' => 'date',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
