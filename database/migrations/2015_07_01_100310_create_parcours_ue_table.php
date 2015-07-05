<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcoursUeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcours_ue', function (Blueprint $table) {
            $table->primary(['parcours_id', 'ue_id']);
            $table->tinyInteger('nbmin');
            $table->tinyInteger('nbmax');
            $table->boolean('est_optionnel');
            $table->integer('parcours_id')->unsigned();
            $table->integer('ue_id')->unsigned();

            $table->foreign('parcours_id')
                ->references('id')->on('parcours')
                ->onDelete('cascade');
            $table->foreign('ue_id')
                ->references('id')->on('ue')
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
        Schema::drop('parcours_ue');
    }
}
