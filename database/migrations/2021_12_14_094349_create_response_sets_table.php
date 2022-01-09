<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_sets', function (Blueprint $table) {
            $table->increments('responseSetID');
            $table->string('emailAddress');
            $table->integer('surveyID')->unsigned();
            $table->timestamps();

            $table->foreign('surveyID')->references('surveyID')->on('surveys')->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('response_sets');
    }
}
