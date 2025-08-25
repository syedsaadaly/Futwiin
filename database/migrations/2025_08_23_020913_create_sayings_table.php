<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSayingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
  
{
    Schema::create('sayings', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('designation')->nullable();
        $table->integer('rating')->default(5);
        $table->text('message');
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
        Schema::dropIfExists('sayings');
    }
}
