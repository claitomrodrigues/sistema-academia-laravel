<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $fillable = [
        'pagamento_id',
        'metodo',
        'codigo_barras',
        'qr_code_pix',
    ];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }
}