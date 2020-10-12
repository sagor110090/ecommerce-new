<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMiniCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('mini_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('subCategory_id')->unsigned();
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('mini_categories');
    }
}
