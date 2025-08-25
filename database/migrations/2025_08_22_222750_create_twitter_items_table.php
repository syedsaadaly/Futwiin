<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterItemsTable extends Migration
{
    public function up()
    {
        Schema::create('twitter_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('twitter_section_id')->constrained()->onDelete('cascade');
            $table->string('username')->nullable();
            $table->string('handle')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('twitter_items');
    }
}
