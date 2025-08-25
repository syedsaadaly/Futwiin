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
            $table->string('heading')->nullable(); // new field
            $table->string('text'); // point text
            $table->string('image')->nullable(); // new field for image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_points');
    }
}
