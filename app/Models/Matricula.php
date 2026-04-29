<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'aluno_id',
        'plano_id',
        'data_inicio',
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

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }
}