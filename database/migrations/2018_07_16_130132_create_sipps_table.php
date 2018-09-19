<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSippsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipps', function (Blueprint $table) {
            $table->increments('id');
			$table->string('car_model',10)->default('')->nullable();
            $table->integer('car_dor_id')->default(0)->nullable();
            $table->integer('car_class_id')->default(0)->nullable();
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
        Schema::dropIfExists('sipps');
    }
}
