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
            $table->primary(['id_parcours', 'id_ue']);
            $table->tinyInteger('nbmin');
            $table->tinyInteger('nbmax');
            $table->boolean('est_operationel');
            $table->integer('id_parcours')->unsigned();
            $table->integer('id_ue')->unsigned();

            $table->foreign('id_parcours')
                ->references('id')->on('parcours')
                ->onDelete('cascade');
            $table->foreign('id_ue')
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
