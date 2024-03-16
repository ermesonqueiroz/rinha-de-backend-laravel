<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'valor' => ['required', 'integer'],
            'tipo' => ['required', 'string'],
            'descricao' => ['required', 'string', 'max:10'],
        ];
    }
}
