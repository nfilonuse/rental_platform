<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAffiliateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_affiliate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('commission_car', 8, 2)->default(0);
            $table->float('commission_hotel', 8, 2)->default(0);
            $table->string('referral_id')->nullable();
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
        Schema::dropIfExists('user_affiliate');
    }
}
