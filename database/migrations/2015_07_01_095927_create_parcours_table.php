<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intitule', 50);
            $table->string('description', 500);
            $table->tinyInteger('annee');
            $table->tinyInteger('nb_opt_s1')->nullable();
            $table->tinyInteger('nb_opt_s2')->nullable();
            $table->dateTime('deb_choix_s1')->nullable();
            $table->dateTime('fin_choix_s1')->nullable();
            $table->dateTime('deb_choix_s2')->nullable();
            $table->dateTime('fin_choix_s2')->nullable();
            $table->integer('id_specialite')->unsigned();

            $table->foreign('id_specialite')
                ->references('id')->on('specialite')
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
        Schema::drop('parcours');
    }
}
