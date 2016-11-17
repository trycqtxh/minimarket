<?php

use Illuminate\Database\Seeder;
use App\Status;

class SeederTableStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_admin = new Status();
        $status_admin->status = "ADMIN";
        $status_admin->save();

        $status_manager = new Status();
        $status_manager->status = "MANAGER";
        $status_manager->save();

        $status_kasir = new Status();
        $status_kasir->status = "KASIR";
        $status_kasir->save();
    }
}
