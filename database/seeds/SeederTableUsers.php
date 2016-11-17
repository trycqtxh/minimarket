<?php

use Illuminate\Database\Seeder;
use App\Users;
use App\Status;

class SeederTableUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $s_admin = $status->where('status', 'ADMIN')->pluck('id')->first();
        $s_manager = $status->where('status', 'MANAGER')->pluck('id')->first();
        $s_kasir = $status->where('status', 'KASIR')->pluck('id')->first();

        $admin = new Users();
        $admin->nama = "Faisal Abdul Hamid";
        $admin->username = "faisal";
        $admin->password = 'faisal';
        $admin->id_status = $s_admin;
        $admin->save();

        $manager = new Users();
        $manager->nama = "Cecep Zainal Mustofa";
        $manager->username = "cecep";
        $manager->password = 'cecep';
        $manager->id_status = $s_manager;
        $manager->save();

        $kasir = new Users();
        $kasir->nama = "Andi Hidayat";
        $kasir->username = "andi";
        $kasir->password = 'andi';
        $kasir->id_status = $s_kasir;
        $kasir->save();

    }
}
