<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function($table) {
        	$table->boolean('is_admin')->default(false);
			$table->integer('client_id')->default(0);
		});
		Schema::table('users', function($table) {
			$table->index('client_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('users', function($table) {
        	$table->dropColumn('is_admin');
			$table->dropColumn('client_id');

		});
    }
}
