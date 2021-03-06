<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOauthClientsTableRequestDomainName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oauth_clients', function (Blueprint $table) {
            $table->integer('tipo_id')->unsigned()->default(1);
            $table->foreign('tipo_id')->references('id')->on('tipo_usuario')
            ->onDelete('cascade');
            $table->integer('numero_identificacion')->default(1234567);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_clients', function (Blueprint $table) {
            //
        });
    }
}
