<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('payable');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('provider')->default('wave');
            $table->string('checkout_id')->nullable()->index();
            $table->string('transaction_id')->nullable()->index();
            $table->string('client_reference')->nullable()->index();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('currency', 3)->default('XOF');
            $table->string('status')->default('pending');
            $table->string('payment_status')->nullable();
            $table->string('checkout_status')->nullable();
            $table->text('error_message')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['provider', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};