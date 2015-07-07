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
            $table->primary(['parcours_id', 'ue_id', 'user_id']);
            $table->dateTime('date_choix')->default(date("Y-m-d H:i:s"));
            $table->integer('parcours_id')->unsigned();
            $table->integer('ue_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('parcours_id')
                ->references('id')->on('parcours')
                ->onDelete('cascade');
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
        Schema::drop('choix');
    }
}
