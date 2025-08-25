<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('home_testimonials', function (Blueprint $table) {
$table->id();
$table->unsignedTinyInteger('rating')->default(5); // 1..5
$table->text('review');
$table->string('name');
$table->string('since_label')->nullable(); // e.g. "Member since 2022"
$table->string('avatar')->nullable();
$table->unsignedInteger('sort_order')->default(0);
$table->boolean('status')->default(true);
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('home_testimonials');
}
}
