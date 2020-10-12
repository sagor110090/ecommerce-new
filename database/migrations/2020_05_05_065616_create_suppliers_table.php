<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration
{
  
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('total_paid_amount')->nullable();
            $table->integer('total_paid_due')->nullable();
            });
    }

  
    public function down()
    {
        Schema::drop('suppliers');
    }
}
