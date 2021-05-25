<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade');
            $table->integer('subdistrict_id')->unsigned();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts')->onUpdate('cascade');
            $table->string('receiver_name');
            $table->string('mobile_number');
            $table->string('details');
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
        Schema::dropIfExists('addresses');
    }
}
