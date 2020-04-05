<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone', 50)->nullable();

            $table->integer('country_id')->nullable()->unsigned();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');

            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->integer('finished_profile')->default(0);
            $table->text('google_id', 50)->nullable();
            $table->float('rate_total')->default(0);
            $table->integer('rate_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
