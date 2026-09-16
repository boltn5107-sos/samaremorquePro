<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervention_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->text('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->index('intervention_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_statuses');
    }
};
