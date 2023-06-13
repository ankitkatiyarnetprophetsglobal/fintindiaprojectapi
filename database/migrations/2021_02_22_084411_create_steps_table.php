<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable();
			$table->bigInteger('steps')->unsigned();
			$table->bigInteger('noofevent')->unsigned();
			$table->string('calorie')->nullable();
            $table->string('point')->nullable();
            $table->string('speed')->nullable();
            $table->string('distance')->nullable();
			$table->bigInteger('goal')->nullable();
			$table->date('for_date')->nullable();
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
        Schema::dropIfExists('steps');
    }
}
