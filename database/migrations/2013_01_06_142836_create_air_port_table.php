<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirPortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_port', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('latitude_deg');
            $table->string('longitude_deg');
            $table->string('iso_country');
            $table->string('municipality');
            $table->string('scheduled_service');
            $table->string('code');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('air_port');
    }
}
