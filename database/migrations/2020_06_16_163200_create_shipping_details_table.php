<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone_number');
            $table->string('state');
            $table->string('email');
            $table->string('city');
            $table->string('address');
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->integer('customerInfo_id')->unsigned();
            $table->foreign('customerInfo_id')->references('id')->on('customer_infos')->onDelete('cascade');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_details');
    }
}