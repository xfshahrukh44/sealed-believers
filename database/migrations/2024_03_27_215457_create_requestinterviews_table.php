<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestinterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestinterviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('subject')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('is_approved')->nullable();
            $table->text('details')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requestinterviews');
    }
}
