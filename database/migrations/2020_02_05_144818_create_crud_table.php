<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrudTable extends Migration
{
  
    public function up()
    {
        Schema::create('crud', function (Blueprint $table) {
            $table->increments('id');
            $table->json('content')->nullable();
            
            });
    }

  
    public function down()
    {
        Schema::drop('crud');
    }
}
