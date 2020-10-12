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
            $table->string('order_amount');
            $table->string('shipping_charge');
            $table->string('total_item');
            $table->string('payment_status');
            $table->string('delivery_status');
            $table->string('payment_method');
            $table->boolean('show')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->integer('customerInfo_id')->unsigned();
            $table->foreign('customerInfo_id')->references('id')->on('customer_infos')->onDelete('cascade');
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