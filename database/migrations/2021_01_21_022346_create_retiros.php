<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retiros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_retiro');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_cuenta')->unsigned();
            $table->integer('valor_retiro');
            $table->datetime('fecha_retiro')->nullable()->change();

            $table->text('descripcion');
        
            $table->timestamps();
        });

        
        Schema::table('retiros', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('id_cuenta')->references('id')->on('cuentas')
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
        Schema::dropIfExists('retiros');
    }
}
