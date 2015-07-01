<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choix', function (Blueprint $table) {
            $table->primary(['id_parcours', 'id_ue']);
            $table->dateTime('date_choix')->default(date("Y-m-d H:i:s"));
            $table->integer('id_parcours')->unsigned();
            $table->integer('id_ue')->unsigned();
            $table->integer('id_user')->unsigned();

            $table->foreign('id_parcours')
                ->references('id')->on('parcours')
                ->onDelete('cascade');
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
        Schema::drop('choix');
    }
}
