<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cert_ques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cert_cats_id')->unsigned();
            $table->integer('questypeid');
            $table->integer('priority');
            $table->text('title');
            $table->timestamps();
            $table->foreign('cert_cats_id')->references('id')->on('cert_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cert_ques');
    }
}
