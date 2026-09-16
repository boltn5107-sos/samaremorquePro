<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('address')->nullable();
            $table->timestamp('recorded_at');

            $table->index('user_id');
            $table->index(['lat', 'lng']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
