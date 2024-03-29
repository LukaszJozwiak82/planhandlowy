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
        Schema::create('loan_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->unsigned()->nullable();
            $table->foreignId('loan_id')->unsigned()->nullable();
            $table->boolean('is_sale')->default(false);
            $table->integer('value')->nullable();
            $table->integer('current_funding')->nullable();
            $table->decimal('rrso')->nullable();
            $table->integer('points')->default(0)->nullable();
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
        Schema::dropIfExists('loan_sales');
    }
};
