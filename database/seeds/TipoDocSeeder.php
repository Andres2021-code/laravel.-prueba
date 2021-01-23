<?php

use Illuminate\Database\Seeder;

class TipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert([
            "nombre_doc" => "CC"
        ]);
    }
}
