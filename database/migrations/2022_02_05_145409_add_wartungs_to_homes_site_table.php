<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWartungsToHomesSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homes_site', function (Blueprint $table) {
            $table->boolean('wartungs');
            $table->boolean('preloader');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homes_site', function (Blueprint $table) {
            $table->dropColumn('wartungs');
            $table->dropColumn('preloader');
        });
    }
}
