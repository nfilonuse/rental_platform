<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('checkout_detail_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->string('reservation_number',100)->default('');
			$table->integer('voucher_number');	
			$table->string('record_loc',100)->default('');
			$table->integer('company_id')->default(0);
			
			//$table->string('car_class_code',100)->default('');
			$table->integer('car_class_id')->default(0);

			$table->integer('agent_id')->default(0);

			$table->integer('rate_id')->default(0);
			//$table->string('rate_code')->default('');	

			$table->integer('account_id')->default(0);
			//$table->string('account_number')->default('');
			
			$table->integer('coupon_id')->default(0);
			//$table->string('coupon_number',50)->default('');

			$table->string('reservation_first_name')->default('');
			$table->string('reservation_last_name')->default('');

			$table->string('reservation_phone_number',20)->default('');
            $table->string('reservation_email',100)->default('');

            $table->string('reservation_country',100)->default('');


			$table->integer('reservation_plocation_id')->default(0);
            $table->string('reservation_pdate')->default('0000-00-00');
            $table->string('reservation_ptime')->default('00:00:00');
			$table->integer('reservation_dlocation_id')->default(0);
            $table->string('reservation_ddate')->default('0000-00-00');
            $table->string('reservation_dtime')->default('00:00:00');

            $table->string('reservation_for_days',10)->default('');
            $table->string('reservation_currency_code',10)->default('USD');
			
			$table->float('reservation_total_amount',8,2)->default(0);
			$table->float('reservation_weekly_amount',8,2)->default(0);
			$table->float('reservation_daily_amount',8,2)->default(0);
			
			$table->string('reservation_cancel_number',10)->default('');
			$table->string('reservation_cancel_comments',10)->nullable();
			$table->smallInteger('reservation_cancel')->default(0);
			$table->datetime('reservation_cancel_date')->nullable();

			$table->smallInteger('reservation_buy')->default(0);
			$table->smallInteger('reservation_payment_option')->default(0);
			$table->datetime('reservation_buy_date')->nullable();


            $table->datetime('reservation_date');
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
        Schema::dropIfExists('orders');
    }
}
