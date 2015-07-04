<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom',100);
            $table->string('nom',100);
            $table->string('mail',100)->unique();
            $table->string('mdp', 255);
            $table->string('login',50);
            $table->boolean('actif')->default(false);
            $table->integer('id_profil')->unsigned()->nullable();
            $table->integer('id_groupe')->unsigned()->nullable();
            $table->integer('id_parcours')->unsigned()->nullable();

            $table->foreign('id_profil')
                ->references('id')->on('profil')
                ->onDelete('cascade');
            $table->foreign('id_groupe')
                ->references('id')->on('groupe')
                ->onDelete('cascade');
            $table->foreign('id_parcours')
                ->references('id')->on('parcours')
                ->onDelete('cascade');

            $table->rememberToken();
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
        Schema::drop('user');
    }
}
