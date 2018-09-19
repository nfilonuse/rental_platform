<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_details', function (Blueprint $table) {
            $table->increments('id');

			$table->integer('user_id')->default(0);

			$table->string('billing_first_name')->default('');
			$table->string('billing_last_name')->default('');

			$table->string('billing_company')->default('');
			$table->string('billing_phone',20)->default('');
			$table->string('billing_address',255)->default('');

            $table->string('billing_email',100)->default('');
            $table->string('billing_art',50)->default('');
            $table->string('billing_city',100)->default('');

			$table->integer('billing_country_id')->default(0);
			$table->integer('billing_state_id')->default(0);

            $table->string('billing_zip_code',100)->default('');

            $table->smallInteger('send_notified')->default(0);
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
        Schema::dropIfExists('checkout_details');
    }
}
