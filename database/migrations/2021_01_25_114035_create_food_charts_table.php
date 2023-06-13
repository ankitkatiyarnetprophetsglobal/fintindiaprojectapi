<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_charts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('servingquantity');
            $table->integer('measurement');
            $table->tinyInteger('foodname_id');
             $table->tinyInteger('servingquantity_id');
            $table->string('unit');
            $table->integer('calories')->comment('in Kcal');
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
        Schema::dropIfExists('food_charts');
    }
}
