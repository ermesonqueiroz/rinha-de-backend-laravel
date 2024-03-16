<?php

namespace App\Http\Controllers\API;

use App\Adapters\TransactionAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Customer;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    public function index(int $customerId)
    {
        $customer = Customer::find($customerId)->first();
        $transactions = $customer->transactions()->orderBy('created_at', 'desc')->limit(10)->get();

        return response()->json([
            'saldo' => [
                'total' => $customer->balance(),
                'data_extrato' => Carbon::now()->toIso8601String(),
                'limite' => $customer->limit
            ],
            'ultimas_transacoes' => $transactions->map(function ($transaction) {
                return [
                    'valor' => $transaction->amount,
                    'tipo' => $transaction->type,
                    'descricao' => $transaction->description,
                    'realizada_em' => (new Carbon($transaction->created_at))->toIso8601String()
                ];
            })
        ]);
    }

    public function store(int $customerId, StoreTransactionRequest $storeTransactionRequest)
    {
        $data = TransactionAdapter::adapt($storeTransactionRequest->validated());
        $customer = Customer::where('id', $customerId)->first();

        if ($data['type'] == 'd' && $customer->balance() - $data['amount'] < - $customer->limit) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }

        $customer->transactions()->create($data);

        return response()->json([
            'limite' => $customer->limit,
            'saldo' => $customer->balance()
        ]);
    }
}
