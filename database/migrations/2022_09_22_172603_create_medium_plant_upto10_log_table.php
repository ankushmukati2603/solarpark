<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumPlantUpto10LogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_plant_upto10_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('user_state_id');
            $table->integer('application_id');
            $table->integer('organization_name');
            $table->integer('organization_address');
            $table->integer('project_name');
            $table->integer('project_address');
            $table->integer('applications_details');
            $table->integer('capacity');
            $table->integer('cattles_details');
            $table->integer('other_sources');
            $table->integer('manufacturer_name');
            $table->integer('required_daily_power');
            $table->integer('biogas_generation');
            $table->integer('no_of_plants');
            $table->integer('operational_hours');
            $table->integer('actual_cost');
            $table->integer('project_cost');
            $table->integer('amount_of_cfa');
            $table->integer('undertaking'); $table->integer('status')->comment('0 - pending,1-approved,2 - Pertial Approved,3 - Reject');
            $table->text('sna_remarks')->nullable();
            $table->text('mnre_remarks_by_sna')->nullable(); 
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
        Schema::dropIfExists('medium_plant_upto10_log');
    }
}
