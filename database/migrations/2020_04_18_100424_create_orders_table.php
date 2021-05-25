<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('order_status_id')->unsigned();
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('basket_id')->unsigned();
            $table->foreign('basket_id')->references('id')->on('baskets')->onUpdate('cascade');
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade');
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
