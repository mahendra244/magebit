<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMessageIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_message_id', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_id')->nullable();
            $table->string('message_status')->nullable();
            $table->string('process_date')->nullable();
            $table->tinyInteger('email_user_id')->nullable();
            $table->string('click_status')->nullable();
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
        Schema::dropIfExists('user_message_id');
    }
}
