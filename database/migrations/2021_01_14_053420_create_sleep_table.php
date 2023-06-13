<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSleepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sleep', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('bed_date',12)->nullable();
            $table->string('bed_time',15)->nullable();
            $table->string('wakup_date',12)->nullable();
            $table->string('wakup_time',15)->nullable();
            $table->integer('sleep_hours')->nullable();
            $table->integer('goal_achieve')->default(0);
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
        Schema::dropIfExists('Sleep');
    }
}
