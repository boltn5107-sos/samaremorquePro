<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->change();

            $table->string('tracking_code')->nullable()->unique()->after('id');
            $table->string('client_name')->nullable()->after('client_id');
            $table->string('client_phone')->nullable()->after('client_name');
            $table->string('vehicle_type')->nullable()->after('vehicle_id');
        });
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['tracking_code', 'client_name', 'client_phone', 'vehicle_type']);
            $table->foreignId('client_id')->nullable(false)->change();
        });
    }
};