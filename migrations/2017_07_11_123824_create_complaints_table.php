<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();
            $table->integer('dev_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('mai_id')->unsigned();
            $table->string('feedback')->nullable();
            $table->boolean('fixed')->default(0);
            $table->timestamps();
            $table->foreign('dev_id')->references('id')->on('devices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mai_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
