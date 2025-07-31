<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
		Schema::create('pridections', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('team_1_id');
            $table->uuid('team_2_id');
            $table->string('title');
            $table->date('match_date');
            $table->time('match_time');
            $table->text('text')->nullable();
            $table->boolean('is_teaser')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('team_1_id')->references('uuid')->on('teams');
            $table->foreign('team_2_id')->references('uuid')->on('teams');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pridections');
	}
};
