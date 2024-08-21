<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pe_name1')->nullable();
            $table->string('org_id')->nullable();
            $table->string('pe_id')->nullable();
            $table->string('name1')->nullable();
            $table->string('geo_level1')->nullable();
            $table->string('country1')->nullable();
            $table->string('planning_grp_desc')->nullable();
            $table->string('cp_name')->nullable();
            $table->string('sap_top_view_name1')->nullable();
            $table->string('regional_buying_classification_text')->nullable();
            $table->string('sap_master_code_text')->nullable();
            $table->string('sales_group_name')->nullable();
            $table->string('sales_office_name')->nullable();
            $table->string('internal_account_classification')->nullable();
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
        Schema::dropIfExists('company');
    }
}
