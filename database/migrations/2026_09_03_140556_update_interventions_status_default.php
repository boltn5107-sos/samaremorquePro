<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Intervention;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->string('status')->default(Intervention::STATUS_AWAITING_PROFESSIONAL)->change();
        });

        DB::table('interventions')
            ->where('status', 'demande_recue')
            ->update(['status' => Intervention::STATUS_AWAITING_PROFESSIONAL]);
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->string('status')->default('demande_recue')->change();
        });
    }
};
