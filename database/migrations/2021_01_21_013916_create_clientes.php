<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
      
            $table->Integer('tipo_doc')->unsigned();
            $table->bigInteger('numero_cedula')->unsigned();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->string('email')->unique();
        
            $table->timestamps();
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->foreign('tipo_doc')->references('id')->on('tipo_documento')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
