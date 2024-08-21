<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->string('city_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('event_type')->nullable();
            $table->string('event_name')->nullable();
            $table->string('event_date')->nullable();
            $table->string('is_unique')->nullable();
            $table->string('is_unique_num')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('status')->nullable();
            $table->string('register_date')->nullable();
            $table->string('is_attended')->nullable();
            $table->string('unique_code')->nullable();
            $table->string('org_id')->nullable();
            $table->string('pe_id')->nullable();
            $table->string('company_updated')->nullable();
            $table->string('is_updated')->nullable();
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
        Schema::dropIfExists('employee');
    }
}
