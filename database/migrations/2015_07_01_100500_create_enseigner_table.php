<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseigner', function (Blueprint $table) {
            $table->primary(['ue_id', 'user_id']);
            $table->integer('ue_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('ue_id')
                ->references('id')->on('ue')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('user')
                ->onDelete('cascade');

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
        Schema::drop('enseigner');
    }
}
