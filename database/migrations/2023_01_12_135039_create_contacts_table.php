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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->date('contact_date')->nullable();
            $table->foreignId('user_id')->unsigned();
            $table->foreignId('client_id')->unsigned()->nullable();
            $table->string('client')->nullable();
            $table->enum('type', ['telefon', 'email', 'spotkanie'])->default('telefon');
            $table->string('purpose')->nullable();
            $table->string('result')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
