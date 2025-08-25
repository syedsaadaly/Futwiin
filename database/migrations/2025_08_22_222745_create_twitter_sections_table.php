<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('twitter_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); 
            $table->text('description')->nullable();
            $table->string('button_text')->default('Follow Us on Twitter');
            $table->string('button_link')->default('https://twitter.com/FutWin_Official');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('twitter_sections');
    }
}
