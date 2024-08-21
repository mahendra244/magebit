<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUploadTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_upload_track', function (Blueprint $table) {
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
        Schema::dropIfExists('company_upload_track');
    }
}
