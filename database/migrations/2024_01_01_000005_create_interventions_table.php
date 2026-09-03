<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('professional_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->string('service_type');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('en_attente_professionnel');
            $table->decimal('client_lat', 10, 7)->nullable();
            $table->decimal('client_lng', 10, 7)->nullable();
            $table->string('client_address')->nullable();
            $table->string('destination')->nullable();
            $table->decimal('destination_lat', 10, 7)->nullable();
            $table->decimal('destination_lng', 10, 7)->nullable();
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->integer('estimated_duration_minutes')->nullable();
            $table->text('client_manual_position')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('client_id');
            $table->index('professional_id');
            $table->index('status');
            $table->index(['client_lat', 'client_lng']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
