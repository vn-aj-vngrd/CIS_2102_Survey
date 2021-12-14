<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('responseID');
            $table->integer('response_setID')->unsigned();
            $table->integer('questionID')->unsigned();
            $table->integer('rating');

            $table->foreign('response_setID')->references('response_setID')->on('response_sets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('questionID')->references('questionID')->on('questions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
