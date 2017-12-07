<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_countries', function(BLueprint $table){
            $table->increments('id');
            $table->string('country_name',100);
        });

        Schema::create('ce_cities', function(BLueprint $table){
            $table->increments('id');
            $table->string('city_name',100);
            $table->integer('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ce_countries');
        Schema::dropIfExists('ce_cities');
    }
}
