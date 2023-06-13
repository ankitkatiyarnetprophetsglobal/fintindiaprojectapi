<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareyourstoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareyourstories', function (Blueprint $table) {
            $table->id();
            $table->string('youare');
            $table->string('designation');
            $table->string('email');
            $table->string('fullname');
            $table->string('videourl');
            $table->text('title');
            $table->string('image');
            $table->string('story');
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
        Schema::dropIfExists('shareyourstories');
    }
}
