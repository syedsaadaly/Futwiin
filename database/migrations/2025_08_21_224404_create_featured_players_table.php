<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
   Schema::create('featured_players', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('club');
    $table->integer('age');
    $table->string('position');
    $table->string('nationality'); // <= yeh zaroori hai
    $table->string('stats')->nullable();
    $table->text('description')->nullable();
    $table->string('image')->nullable();
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
        Schema::dropIfExists('featured_players');
    }
}
