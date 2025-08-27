<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPointsTable extends Migration
{
    public function up()
    {
        Schema::create('member_points', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable(); 
            $table->string('text'); 
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_points');
    }
}
