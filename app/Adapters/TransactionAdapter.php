<?php

namespace App\Adapters;

class TransactionAdapter
{
    public static function adapt(array $data): array
    {
        return [
            'amount' => $data['valor'],
            'type' => $data['tipo'],
            'description' => $data['descricao']
        ];
    }
}
