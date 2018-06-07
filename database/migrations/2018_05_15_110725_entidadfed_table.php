<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntidadfedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidadfed', function (Blueprint $table) {
            $table->increments('id');
            $table->smallinteger('no');
            $table->string('descripcion',40);
            $table->tinyInteger('modificado');
            $table->binary('imagen')->nullable();
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
        Schema::drop('entidadfed');
    }
}
