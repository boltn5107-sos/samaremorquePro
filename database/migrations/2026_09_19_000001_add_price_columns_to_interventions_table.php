<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Prix de la course renseigne par le professionnel et confirmation par le client.
     *
     * price_status :
     *  - en_attente_confirmation : le pro a saisi un prix, le client doit le confirmer
     *  - valide                  : le client a confirme le prix -> la commission est due
     *  - conteste                : le client conteste le prix -> le pro doit le corriger
     */
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->nullable()->after('status');
            $table->string('price_status')->nullable()->after('price');
            $table->timestamp('price_set_at')->nullable()->after('price_status');
            $table->timestamp('price_confirmed_at')->nullable()->after('price_set_at');
        });
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['price', 'price_status', 'price_set_at', 'price_confirmed_at']);
        });
    }
};