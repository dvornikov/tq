<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsAndFilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('files', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->default(0);
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->string('filename');
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
        Schema::drop('tickets');
        Schema::drop('files');
    }
}
