<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingChargesTable extends Migration
{
  
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->integer('amount')->nullable();
            $table->string('status')->nullable();
            });
    }

  
    public function down()
    {
        Schema::drop('shipping_charges');
    }
}
