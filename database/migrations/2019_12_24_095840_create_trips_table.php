<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->integerIncrements('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('begin_place')->unsigned();
            $table->foreign('begin_place')->references('id')->on('airports')->onDelete('cascade');

            $table->integer('arrival_place')->unsigned();
            $table->foreign('arrival_place')->references('id')->on('airports')->onDelete('cascade');
            
            $table->dateTime('begin_time');
            $table->dateTime('arrival_time');
            $table->string('size', 50);
            $table->text('description')->nullable();
            $table->boolean('disable')->default(0);
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
        Schema::dropIfExists('trips');
    }
}
