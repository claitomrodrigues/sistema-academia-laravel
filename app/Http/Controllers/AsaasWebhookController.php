<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;

class AsaasWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $token = $request->header('Asaas-Webhook-Token');

        if ($token !== env('ASAAS_WEBHOOK_TOKEN')) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $payload = $request->all();

        $evento = $payload['event'] ?? null;

        $payment = $payload['payment'] ?? null;

        if (!$payment) {
            return response()->json([
                'message' => 'Pagamento não encontrado no payload'
            ], 400);
        }

        $transacao = Transacao::where(
            'asaas_payment_id',
            $payment['id']
        )->first();

        if (!$transacao) {
            return response()->json([
                'message' => 'Transação não encontrada'
            ], 404);
        }

        switch ($evento) {

            case 'PAYMENT_RECEIVED':

                $transacao->status = 'RECEIVED';
                $transacao->save();

                $transacao->pagamento->status = 'pago';
                $transacao->pagamento->save();

            break;

            case 'PAYMENT_CONFIRMED':

                $transacao->status = 'CONFIRMED';
                $transacao->save();

                $transacao->pagamento->status = 'pago';
                $transacao->pagamento->save();

            break;

            case 'PAYMENT_OVERDUE':

                $transacao->status = 'OVERDUE';
                $transacao->save();

                $transacao->pagamento->status = 'pendente';
                $transacao->pagamento->save();

            break;

            case 'PAYMENT_DELETED':

                $transacao->status = 'DELETED';
                $transacao->save();

            break;
        }

        return response()->json([
            'message' => 'Webhook processado com sucesso'
        ]);
    }
}