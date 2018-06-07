<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sismos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sismos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha');
            $table->time('hora');
            $table->double('latitud', 15, 8);
            $table->double('longitud', 15, 8);
            $table->double('profundidad', 8, 5);
            $table->double('magnitud', 8, 3);
            $table->double('magnitud_prel', 8, 3);
            $table->string('red', 25);
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
        Schema::drop('sismos');
    }
}