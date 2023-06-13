<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsermetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermetas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('block')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile')->nullable();
            $table->string('orgname')->nullable();
            $table->string('udise')->nullable();
            $table->string('pincode')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('image')->nullable();
			$table->string('board')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usermetas');
    }
}
