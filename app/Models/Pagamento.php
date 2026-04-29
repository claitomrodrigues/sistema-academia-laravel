<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'matricula_id',
        'valor',
        'vencimento',
        'status',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function transacao()
    {
        return $this->hasOne(Transacao::class);
    }
}