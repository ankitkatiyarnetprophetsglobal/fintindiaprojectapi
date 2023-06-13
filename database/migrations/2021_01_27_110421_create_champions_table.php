<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->string('designation')->nullable();
            $table->string('state_name')->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('district_name')->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->string('block_name')->nullable();
            $table->bigInteger('block_id')->unsigned()->nullable();
            $table->string('pincode')->nullable();
            $table->string('image')->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('facebook_profile_followers')->nullable();
            $table->string('twitter_profile')->nullable();
            $table->string('twitter_profile_followers')->nullable();
            $table->string('instagram_profile')->nullable();
            $table->string('instagram_profile_followers')->nullable();
            $table->string('work_profession')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('champions');
    }
}
