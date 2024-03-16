<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->enum('type', ['c', 'd']);
            $table->string('description', 10);
            $table->foreignId('customer_id')->constrained();
            $table->timestamps();
        });
    }

   public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
