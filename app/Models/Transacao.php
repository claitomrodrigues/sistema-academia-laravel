<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    protected $fillable = [
        'pagamento_id',
        'asaas_payment_id',
        'metodo',
        'status',
        'codigo_barras',
        'qr_code_pix',
    ];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }
}