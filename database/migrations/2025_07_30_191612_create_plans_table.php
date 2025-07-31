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
		Schema::create('plans', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->text('text')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('points')->default(0);
            $table->integer('predicted_view_duration_offset')->default(0)->comment('In minutes');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plans');
	}
};
