<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intitule', 50);
            $table->integer('id_parcours')->unsigned();

            $table->foreign('id_parcours')
                ->references('id')->on('parcours')
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
        Schema::drop('groupe');
    }
}
