<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('prediction_id');
            $table->uuid('plan_id');
            $table->integer('points_deduction')->default(0);
            $table->timestamps();
            $table->foreign('prediction_id')->references('id')->on('pridections')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prediction_details');
    }
}
