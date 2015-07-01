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
            $table->primary(['id_ue', 'id_user']);
            $table->integer('id_ue')->unsigned();
            $table->integer('id_user')->unsigned();

            $table->foreign('id_ue')
                ->references('id')->on('ue')
                ->onDelete('cascade');
            $table->foreign('id_user')
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
