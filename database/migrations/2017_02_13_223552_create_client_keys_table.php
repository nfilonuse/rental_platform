<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_keys', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('client_id')->unsigned();
            $table->string('api_key');
            $table->string('api_secret');
            $table->boolean('is_test');
			$table->timestamp('date_exp');
            $table->timestamps();
        });

		Schema::table('clients_keys', function($table) {
			$table->foreign('client_id')->references('id')->on('clients');
		});

		Schema::table('clients_keys', function($table) {
			$table->index('date_exp');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_keys');
    }
}
