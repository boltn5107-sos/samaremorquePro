<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('preferred_payment')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('remorqueurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('license_number')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->boolean('is_available')->default(false);
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('depanneurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('license_number')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->boolean('is_available')->default(false);
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->json('permissions')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('depanneurs');
        Schema::dropIfExists('remorqueurs');
        Schema::dropIfExists('clients');
    }
};