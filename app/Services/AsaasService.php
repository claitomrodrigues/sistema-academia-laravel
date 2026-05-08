<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AsaasService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('asaas.api_key');
        $this->baseUrl = config('asaas.base_url');
    }

    private function client()
    {
        return Http::withHeaders([
            'access_token' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->baseUrl($this->baseUrl);
    }

    private function limparCpfCnpj(?string $cpfCnpj): string
    {
        return preg_replace('/\D/', '', $cpfCnpj ?? '');
    }

    private function validarCpfCnpj(string $cpfCnpj): void
    {
        if (strlen($cpfCnpj) !== 11 && strlen($cpfCnpj) !== 14) {
            throw new \Exception('CPF/CNPJ inválido. Informe um CPF com 11 dígitos ou CNPJ com 14 dígitos.');
        }

        if (preg_match('/^(\d)\1+$/', $cpfCnpj)) {
            throw new \Exception('CPF/CNPJ inválido. Não use números repetidos como 00000000000.');
        }
    }

    public function criarCliente($aluno)
    {
       $cpfCnpj = $this->limparCpfCnpj($aluno->cpf);

    $this->validarCpfCnpj($cpfCnpj);

    $response = $this->client()->post('/customers', [
        'name' => $aluno->user->name ?? $aluno->nome,
        'cpfCnpj' => $cpfCnpj,
        'email' => $aluno->user->email ?? null,
    ]);

    if ($response->failed()) {
        throw new \Exception('Erro ao criar cliente no Asaas: ' . $response->body());
    }

    return $response->json();
    }

    public function criarCobranca($customerId, $pagamento, string $metodo)
    {
        $billingType = $metodo === 'pix' ? 'PIX' : 'BOLETO';

        $response = $this->client()->post('/payments', [
            'customer' => $customerId,
            'billingType' => $billingType,
            'value' => (float) $pagamento->valor,
            'dueDate' => $pagamento->vencimento,
            'description' => 'Mensalidade FitCloud',
        ]);

        if ($response->failed()) {
            throw new \Exception('Erro ao criar cobrança no Asaas: ' . $response->body());
        }

        return $response->json();
    }

    public function buscarQrCodePix($paymentId)
    {
        $response = $this->client()->get("/payments/{$paymentId}/pixQrCode");

        if ($response->failed()) {
            throw new \Exception('Erro ao buscar QR Code PIX: ' . $response->body());
        }

        return $response->json();
    }

    public function buscarPagamento($paymentId)
    {
        $response = $this->client()->get("/payments/{$paymentId}");

        if ($response->failed()) {
            throw new \Exception('Erro ao buscar pagamento no Asaas: ' . $response->body());
        }

        return $response->json();
    }
}