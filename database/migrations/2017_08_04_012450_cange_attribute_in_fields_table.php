<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CangeAttributeInFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkout_details', function (Blueprint $table) {
			$table->string('billing_company')->default('')->nullable()->change();
            $table->string('billing_art',50)->default('')->nullable()->change();
			$table->integer('billing_state_id')->default(0)->nullable()->change();
            $table->string('billing_zip_code',100)->default('')->nullable()->change();
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
            //
        });
    }
}
