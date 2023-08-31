<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumPlantAbove10LogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_plant_above10_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('user_state_id');
            $table->integer('application_id');
            $table->integer('beneficiary_name');
            $table->integer('beneficiary_address');
            $table->integer('gps');
            $table->integer('contact_number');
            $table->integer('state_agency_name');
            $table->integer('category');
            $table->integer('generated_power');
            $table->integer('required_biogas');
            $table->integer('plant_size');
            $table->integer('cattles');
            $table->integer('other_sources');
            $table->integer('agricultural_waste');
            $table->integer('raw_material_file');
            $table->integer('latrine_attached_no');
            $table->integer('users_no');
            $table->integer('land_for_plant');
            $table->integer('commissioning_procurement_detail');
            $table->integer('quantum_power');
            $table->integer('power_documents');
            $table->integer('engine_type');
            $table->integer('engine_capacity');
            $table->integer('biogas_engine_file');
            $table->integer('plant_cost');
            $table->integer('manure_management');
            $table->integer('electricity_cost');
            $table->integer('project_funding');
            $table->integer('maintenance_funds');
            $table->integer('undertaking_nodal_ajency');
            $table->integer('mechanism_to_transfer');
            $table->integer('project_information');
            $table->integer('undertaking');
            $table->integer('status')->comment('0 - pending,1-approved,2 - Pertial Approved,3 - Reject');
            $table->integer('sna_remarks')->nullable();
            $table->integer('mnre_remarks_by_sna')->nullable(); 
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
        Schema::dropIfExists('medium_plant_above10_log');
    }
}
