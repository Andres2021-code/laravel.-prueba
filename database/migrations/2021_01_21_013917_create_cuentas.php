<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_cuenta');
            $table->integer('id_cliente')->unsigned();
            $table->integer('saldo')->unsigned();
            $table->integer('activa');
            $table->string('clave_cuenta');
            
            $table->text('descripcion');
        
            $table->timestamps();
        });

        Schema::table('cuentas', function (Blueprint $table) {
            $table->foreign('id_cliente')->references('id')->on('clientes')
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
       
        Schema::dropIfExists('cuentas');
    }
}
