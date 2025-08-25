<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('twitter_sections', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('description');
            $table->string('button_link')->nullable()->after('button_text');
            $table->string('twitter_handle')->nullable()->after('button_link');
        });
    }

    public function down(): void
    {
        Schema::table('twitter_sections', function (Blueprint $table) {
            $table->dropColumn(['button_text','button_link','twitter_handle']);
        });
    }
};

