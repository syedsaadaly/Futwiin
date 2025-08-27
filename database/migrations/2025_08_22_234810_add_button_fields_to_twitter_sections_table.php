<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('twitter_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('twitter_sections', 'button_text')) {
                $table->string('button_text')->nullable()->after('description');
            }
            if (!Schema::hasColumn('twitter_sections', 'button_link')) {
                $table->string('button_link')->nullable()->after('button_text');
            }
            if (!Schema::hasColumn('twitter_sections', 'twitter_handle')) {
                $table->string('twitter_handle')->nullable()->after('button_link');
            }
        });
    }

    public function down(): void
    {
        Schema::table('twitter_sections', function (Blueprint $table) {
            if (Schema::hasColumn('twitter_sections', 'button_text')) {
                $table->dropColumn('button_text');
            }
            if (Schema::hasColumn('twitter_sections', 'button_link')) {
                $table->dropColumn('button_link');
            }
            if (Schema::hasColumn('twitter_sections', 'twitter_handle')) {
                $table->dropColumn('twitter_handle');
            }
        });
    }
};
