<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_rental_id')->default(0);
            $table->integer('type_coupon_id')->default(0);
            $table->integer('status_coupon_id')->default(0);
            $table->string('number',50)->default('');
            $table->float('amount',3,2)->default(0);
            $table->dateTime('date_exp')->useCurrent = true;;
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
        Schema::dropIfExists('coupons');
    }
}
