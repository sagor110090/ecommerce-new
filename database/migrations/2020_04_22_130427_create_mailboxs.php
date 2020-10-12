<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailboxs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailboxs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('to', 100);
            $table->string('from', 100);
            $table->longText('content')->nullable();
            $table->string('subject')->nullable();
            $table->string('attach')->nullable();
            $table->string('status',5)->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
