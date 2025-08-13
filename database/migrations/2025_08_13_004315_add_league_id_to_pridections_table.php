<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeagueIdToPridectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pridections', function (Blueprint $table) {
            $table->uuid('league_id')->nullable()->after('team_2_id');
            $table->text('teaser_text')->nullable()->after('text');
            $table->time('end_time')->nullable()->after('match_time');
            $table->string('timezone')->default('UTC')->after('end_time');
            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pridections', function (Blueprint $table) {
            $table->dropForeign(['league_id']);
            $table->dropColumn(['league_id', 'teaser_text', 'end_time', 'timezone']);
        });
    }
}
