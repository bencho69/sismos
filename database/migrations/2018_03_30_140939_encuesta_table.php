<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EncuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitud', 15, 8);
            $table->double('longitud', 15, 8);
            $table->smallInteger('intensidad');
            $table->unsignedInteger('sismo_id');
            $table->decimal('confianza',5,2)->default(0);
            $table->timestamps();

            $table->foreign('sismo_id')->references('id')->on('sismos')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('encuestas');
    }
}
