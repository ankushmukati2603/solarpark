<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmallPlantLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_plant_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('user_state_id');
            $table->integer('application_id');
            $table->integer('name');
            $table->integer('phone');
            $table->integer('email');
            $table->integer('category');
            $table->integer('state_id');
            $table->integer('district_id');
            $table->integer('sub_district_id');
            $table->integer('block');
            $table->integer('village');
            $table->integer('localbody_type');
            $table->integer('panchayat');
            $table->integer('ward_no');
            $table->integer('house_no');
            $table->integer('post');
            $table->integer('toilet_linked');
            $table->integer('existing_biogas_plant');
            $table->integer('slurry_filter_unit');
            $table->integer('cattle_available');
            $table->integer('number_of_cattles');
            $table->integer('comment');
            $table->text('sna_remarks')->nullable();
            $table->text('mnre_remarks_by_sna')->nullable();
            $table->integer('status')->comment('0 - pending,1-approved,2 - Pertial Approved,3 - Reject');
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
        Schema::dropIfExists('small_plant_log');
    }
}
