<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cert_cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status');
            $table->tinyInteger('group')->comment('0 SchoolCert, 1 youthClub');
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
        Schema::dropIfExists('cert_cats');
    }
}
