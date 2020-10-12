<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTable extends Migration
{
  
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('slider_background')->nullable();
            $table->string('slider_lable1')->nullable();
            $table->string('slider_lable2')->nullable();
            $table->string('slider_lable3')->nullable();
            $table->string('slider_lable4')->nullable();
            $table->string('header')->nullable();
            $table->longText('description')->nullable();
            });
    }

  
    public function down()
    {
        Schema::drop('sliders');
    }
}
