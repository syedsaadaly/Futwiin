<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
$table->id();
$table->string('page'); // e.g. 'home'
$table->string('key'); // e.g. 'banner_title'
$table->text('value')->nullable();
$table->timestamps();
$table->unique(['page', 'key']);
});
}


public function down(): void
{
Schema::dropIfExists('page_contents');
}
}
