<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create(['limit' => 100000, 'initial_balance' => 0]);
        Customer::create(['limit' => 80000, 'initial_balance' => 0]);
        Customer::create(['limit' => 1000000, 'initial_balance' => 0]);
        Customer::create(['limit' => 10000000, 'initial_balance' => 0]);
        Customer::create(['limit' => 500000, 'initial_balance' => 0]);
    }
}
