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
        Schema::create('departament_bonuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departament_id')->unsigned();
            $table->integer('reference')->nullable();
            $table->integer('individually')->nullable();
            $table->integer('team')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departament_bonuses');
    }
};
