<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootersSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers_site', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('copyright');
            $table->string('link_column_one');
            $table->string('link_column_two');
            $table->string('link_column_three');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footers_site');
    }
}
