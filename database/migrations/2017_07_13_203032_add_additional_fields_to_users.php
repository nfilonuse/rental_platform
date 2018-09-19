<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function($table) {
        	$table->string('first_name',100)->default('');
			$table->string('last_name',100)->default('');
			$table->string('phone',25)->default('');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       	$table->dropColumn('first_name');
		$table->dropColumn('last_name');
		$table->dropColumn('phone');
    }
}
