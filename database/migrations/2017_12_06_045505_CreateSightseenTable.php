<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSightseenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_sightseen', function(Blueprint $table){
            $table->increments('id');
            $table->string('title',200);
            $table->string('image1',200)->nullable();
            $table->string('image2',200)->nullable();
            $table->string('image3',200)->nullable();
            $table->string('image4',200)->nullable();
            $table->text('description')->nullable();
            $table->float('price',10,2);
            $table->integer('country_id');
            $table->integer('city_id');
            $table->text('information')->nullable();
            $table->smallInteger('discount')->default(0);
            $table->integer('popularity')->default(0);
            $table->boolean('pickup')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ce_sightseen');
    }
}
