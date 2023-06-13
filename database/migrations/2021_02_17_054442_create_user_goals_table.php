<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_goals', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->unsigned();
			$table->string('type')->comment('calorieintake,pedo,water,sleep');
			$table->bigInteger('goal');
			$table->bigInteger('consumed');
			$table->date('for_date');
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
        Schema::dropIfExists('user_goals');
    }
}
