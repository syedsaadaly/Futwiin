<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
Schema::create('twitter_posts', function (Blueprint $table) {
$table->id();
$table->string('title')->default('FutWin');
$table->string('handle')->default('@FutWin_Official');
$table->text('content');
$table->unsignedInteger('sort_order')->default(0);
$table->boolean('status')->default(true);
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('twitter_posts');
}
}
