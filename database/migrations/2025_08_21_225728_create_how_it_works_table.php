<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowItWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('how_it_works', function (Blueprint $table) {
        $table->id();
        $table->string('title');        // Example: "Expert Analysis"
        $table->text('description');    // Example: "Our team of professional analysts..."
        $table->string('icon')->nullable(); // Example: "far fa-search"
        $table->timestamps();
    });
}



public function down(): void
{
Schema::dropIfExists('how_it_works');
}
}
