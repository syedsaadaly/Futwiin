<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPredictionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prediction_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pred_id');
            $table->uuid('user_id');
            $table->uuid('plan_id');
            $table->decimal('old_wallet', 10, 2);
            $table->decimal('new_wallet', 10, 2);
            $table->decimal('points_deduction', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pred_id')->references('id')->on('pridections')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_prediction_logs');
    }
}
