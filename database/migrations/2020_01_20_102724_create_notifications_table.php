<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_relation');
            $table->string('name_relation',50);
            $table->text('message');
            $table->text('redirection');

            $table->integer('from_user')->unsigned();
            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');

            $table->integer('to_user')->unsigned();
            $table->foreign('to_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('notifications');
    }
}
