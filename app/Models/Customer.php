<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'limit',
        'initial_balance'
    ];

    public function balance()
    {
        $total = $this->transactions()->get()->reduce(fn ($acc, $item) => $acc + $item->amount);
        return $this->initial_balance - $total;
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
