<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_send', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_send')->unsigned();
            $table->foreign('user_send')->references('id')->on('users')->onDelete('cascade');

            $table->integer('user_recei')->unsigned();
            $table->foreign('user_recei')->references('id')->on('users')->onDelete('cascade');

            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('transport_requests');
    }
}
