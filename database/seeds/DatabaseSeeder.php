<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Libro;
use App\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Libro::truncate();
        Usuario::truncate();

        $cantUsuarios = 50;
        $cantLibros = 50;

        factory(Usuario::class, $cantUsuarios)->create();
        factory(Libro::class, $cantLibros)->create();

        Schema::enableForeignKeyConstraints();

    }
}
