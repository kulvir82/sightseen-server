<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->float('total_sale_amount',10,2);
            $table->string('status');
            $table->string('card_no');
            $table->string('payment_status');
            $table->float('totaldiscount',10,2);
            $table->float('total_cost',10,2);
            $table->float('tax_amount',10,2);
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
        Schema::dropIfExists('user_bookings');
    }
}
