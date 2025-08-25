<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('cms_pages', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug');
        $table->json('content');
        $table->string('meta_title');
        $table->string('meta_description');
        $table->string('meta_keyword')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('cms_pages');
}

}
