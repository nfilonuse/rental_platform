<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountFieldsInCheckoutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkout_details', function (Blueprint $table) {
			$table->string('account_first_name')->default('');
			$table->string('account_last_name')->default('');

			$table->string('account_company')->default('')->nullable();
			$table->string('account_phone',20)->default('');
			$table->string('account_address',255)->default('');

            $table->string('account_email',100)->default('');
            $table->string('account_art',50)->default('')->nullable();
            $table->string('account_city',100)->default('');

			$table->integer('account_country_id')->default(0);
			$table->integer('account_state_id')->default(0)->nullable();

            $table->string('account_zip_code',100)->default('')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkout_details', function (Blueprint $table) {
			$table->dropColumn('account_first_name');
			$table->dropColumn('account_last_name');

			$table->dropColumn('account_company');
			$table->dropColumn('account_phone');
			$table->dropColumn('account_address');

            $table->dropColumn('account_email');
            $table->dropColumn('account_art');
            $table->dropColumn('account_city');

			$table->dropColumn('account_country_id');
			$table->dropColumn('account_state_id');

            $table->dropColumn('account_zip_code');
        });
    }
}
