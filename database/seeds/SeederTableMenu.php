<?php

use Illuminate\Database\Seeder;
use App\Menu;

class SeederTableMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Status::where('status', 'ADMIN')->first();
        $manager = \App\Status::where('status', 'MANAGER')->first();
        $kasir = \App\Status::where('status', 'KASIR')->first();

        $menu1 = new Menu();
        $menu1->title = 'Dashboard';
        $menu1->icon = 'fa-dashboard';
        $menu1->url = 'dashboard';
        $menu1->save();
        $menu1->status()->attach($admin);
        $menu1->status()->attach($manager);
        $menu1->status()->attach($kasir);

        $menu2 = new Menu();
        $menu2->title = 'Transaction';
        $menu2->icon = 'fa-calculator';
        $menu2->url = 'transaction';
        $menu2->save();
        $menu2->status()->attach($kasir);
        //$menu2->status()->attach($admin);

        $menu3 = new Menu();
        $menu3->title = 'Product';
        $menu3->icon = 'fa-briefcase';
        $menu3->url = 'product';
        $menu3->save();
        $menu3->status()->attach($admin);
        $menu3->status()->attach($manager);
        $menu3->status()->attach($kasir);

        $menu4 = new Menu();
        $menu4->title = 'Stok';
        $menu4->icon = 'fa-exchange';
        $menu4->url = 'stock';
        $menu4->save();
        $menu4->status()->attach($admin);
        $menu4->status()->attach($manager);

        $menu5 = new Menu();
        $menu5->title = 'Pelanggan';
        $menu5->icon = 'fa-users';
        $menu5->url = 'customer';
        $menu5->save();
        $menu5->status()->attach($admin);
        $menu5->status()->attach($manager);
        $menu5->status()->attach($kasir);

        $menu6 = new Menu();
        $menu6->title = 'Supplier';
        $menu6->icon = 'fa-truck';
        $menu6->url = 'supplier';
        $menu6->save();
        $menu6->status()->attach($admin);
        $menu6->status()->attach($manager);

        $menu7 = new Menu();
        $menu7->title = 'Laporan';
        $menu7->icon = 'fa-file-text';
        $menu7->url = 'report';
        $menu7->save();
        $menu7->status()->attach($admin);
        $menu7->status()->attach($manager);
        $menu7->status()->attach($kasir);

        $menu8 = new Menu();
        $menu8->title = 'Setting';
        $menu8->icon = 'fa-gears';
        $menu8->url = 'setting';
        $menu8->save();
        $menu8->status()->attach($admin);
    }
}
