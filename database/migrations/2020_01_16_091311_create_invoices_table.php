<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('id_request')->unsigned();
            $table->foreign('id_request')->references('id')->on('request_send')->onDelete('cascade');

            $table->string('type', 50);
            $table->text('title');
            $table->double('price', 50);
            $table->tinyInteger('paid')->default(0);
            $table->tinyInteger('repaid')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
