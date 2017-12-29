<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLngColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ce_sightseen', function (Blueprint $table){
            $table->float('latitude');
            $table->float('longitude');
        });

        Schema::table('user_bookings', function (Blueprint $table){
            $table->string('booking_number', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ce_sightseen', function (Blueprint $table){
            $table->dropColumn(['latitude', 'longitude']);
        });

        Schema::table('user_bookings', function (Blueprint $table){
            $table->dropColumn('booking_number');
        });
    }
}
