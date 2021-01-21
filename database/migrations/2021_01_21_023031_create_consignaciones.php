<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_consignaciones');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_cuenta')->unsigned();
            $table->integer('valor_consignacion');
            $table->datetime('fecha_consignacion')->nullable()->change();

            
            $table->text('descripcion_consignacion');
        
            $table->timestamps();
        });

        Schema::table('consignaciones', function (Blueprint $table) {
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
        Schema::dropIfExists('consignaciones');
    }
}
