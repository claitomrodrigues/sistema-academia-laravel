<?php

return [

    'api_key' => env('ASAAS_API_KEY'),

    'base_url' => env(
        'ASAAS_BASE_URL',
        'https://api-sandbox.asaas.com/v3'
    ),

    'webhook_token' => env('ASAAS_WEBHOOK_TOKEN'),

];