<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reference_bonuses', function (Blueprint $table) {
            $table->integer('month')->nullable()->after('team');
            $table->integer('year')->nullable()->after('month');
            $table->integer('quarter')->nullable()->after('year');
            $table->integer('individual_components_percent')->nullable()->after('quarter');
            $table->integer('team_components_percent')->nullable()->after('individual_components_percent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reference_bonuses', function (Blueprint $table) {
            $table->dropColumn('month');
            $table->dropColumn('year');
            $table->dropColumn('quarter');
            $table->dropColumn('individual_components_percent');
            $table->dropColumn('team_components_percent');
        });
    }
};
