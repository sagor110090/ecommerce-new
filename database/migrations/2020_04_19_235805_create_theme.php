<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('select_layout')->nullable();
            $table->string('name')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->string('color_theme')->nullable();
            $table->string('mini_sidebar')->nullable();
            $table->string('sticky_header')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme');
    }
}
