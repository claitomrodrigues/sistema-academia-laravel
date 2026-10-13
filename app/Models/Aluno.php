<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'user_id',
        'nome',
        'cpf',
        'nascimento',
        'objetivo',
        'asaas_customer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matricula()
    {
        return $this->hasOne(Matricula::class);
    }

    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }

    public function presencas()
    {
        return $this->hasMany(Presenca::class);
    }
}
