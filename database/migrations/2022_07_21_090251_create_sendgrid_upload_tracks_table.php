<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendgridUploadTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendgrid_upload_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('user_id');
            $table->string('org_filename')->nullable();
            $table->string('file_name')->nullable();
            $table->string('unique_code')->nullable();
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
        Schema::dropIfExists('sendgrid_upload_tracks');
    }
}
