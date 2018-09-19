<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAffiliateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_affiliate_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->float('commission', 8, 2)->default(0);
            $table->float('commission_amount', 8, 2)->default(0);
            $table->timestamps();
        });
        //ALTER TABLE `user_affiliate` CHANGE `commission_car` `commission_car` FLOAT(8,2) NOT NULL DEFAULT '0.00', CHANGE `commission_hotel` `commission_hotel` FLOAT(8,2) NOT NULL DEFAULT '0.00';
        //ALTER TABLE `user_affiliate_orders` CHANGE `commission` `commission` FLOAT(8,2) NOT NULL DEFAULT '0.00', CHANGE `commission_amount` `commission_amount` FLOAT(8,2) NOT NULL DEFAULT '0.00';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_affiliate_orders');
    }
}
