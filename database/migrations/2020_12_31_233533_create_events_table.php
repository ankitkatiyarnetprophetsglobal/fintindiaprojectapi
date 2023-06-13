<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category')->unsigned();
            $table->string('name');
            $table->string('eventimage1')->nullable();
            $table->string('eventimage2')->nullable();
            $table->string('eventstartdate')->nullable();
            $table->string('eventenddate')->nullable();
            
            $table->string('organiser_name')->nullable();
            $table->string('participantnum')->nullable();
            $table->string('kmrun')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
