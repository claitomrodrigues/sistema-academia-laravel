<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use BelongsToTenant;

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
