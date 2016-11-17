<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeederTableStatus::class);

        $this->call(SeederTableMenu::class);
        $this->call(SeederTableSubmenu::class);

        $this->call(SeederTableUsers::class);

        $this->call(SeederKategori::class);
        $this->call(SeederSatuan::class);
    }
}
