<?php

use Illuminate\Database\Seeder;
use App\Submenu;

class SeederTableSubmenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menu = new \App\Menu;
        $dashboard = $menu->where('title', 'Dashboard')->pluck('id')->first();
        $transaksi = $menu->where('title', 'Transaction')->pluck('id')->first();
        $produk = $menu->where('title', 'Product')->pluck('id')->first();
        $stok = $menu->where('title', 'Stok')->pluck('id')->first();
        $pelanggan = $menu->where('title', 'Pelanggan')->pluck('id')->first();
        $supplier = $menu->where('title', 'Supplier')->pluck('id')->first();
        $laporan = $menu->where('title', 'Laporan')->pluck('id')->first();
        $setting = $menu->where('title', 'Setting')->pluck('id')->first();

        $admin = \App\Status::where('status', 'ADMIN')->first();
        $manager = \App\Status::where('status', 'MANAGER')->first();
        $kasir = \App\Status::where('status', 'KASIR')->first();

        $submenu1 = new Submenu();
        $submenu1->title = 'Data Item';
        $submenu1->icon = 'fa-briefcase';
        $submenu1->url = 'product';
        $submenu1->id_menu = $produk;
        $submenu1->save();
        $submenu1->status()->attach($admin);
        $submenu1->status()->attach($manager);
        $submenu1->status()->attach($kasir);

        $submenu2 = new Submenu();
        $submenu2->title = 'Kategori';
        $submenu2->icon = 'fa-list-alt';
        $submenu2->url = 'category';
        $submenu2->id_menu = $produk;
        $submenu2->save();
        $submenu2->status()->attach($admin);
        $submenu2->status()->attach($manager);
        $submenu2->status()->attach($kasir);

        $submenu3 = new Submenu();
        $submenu3->title = 'Satuan';
        $submenu3->icon = 'fa-list';
        $submenu3->url = 'unit';
        $submenu3->id_menu = $produk;
        $submenu3->save();
        $submenu3->status()->attach($admin);
        $submenu3->status()->attach($manager);
        $submenu3->status()->attach($kasir);

        $submenu4 = new Submenu();
        $submenu4->title = 'Item Masuk';
        $submenu4->icon = 'fa-sign-in';
        $submenu4->url = 'stock-in';
        $submenu4->id_menu = $stok;
        $submenu4->save();
        $submenu4->status()->attach($admin);
        $submenu4->status()->attach($manager);

        $submenu5 = new Submenu();
        $submenu5->title = 'Item Keluar';
        $submenu5->icon = 'fa-sign-out';
        $submenu5->url = 'stock-out';
        $submenu5->id_menu = $stok;
        $submenu5->save();
        $submenu5->status()->attach($admin);
        $submenu5->status()->attach($manager);

        $submenu6 = new Submenu();
        $submenu6->title = 'Penjualan';
        $submenu6->icon = 'fa-file-text';
        $submenu6->url = 'sales-report';
        $submenu6->id_menu = $laporan;
        $submenu6->save();
        $submenu6->status()->attach($admin);
        $submenu6->status()->attach($manager);
        $submenu6->status()->attach($kasir);

        $submenu7 = new Submenu();
        $submenu7->title = 'Item Masuk';
        $submenu7->icon = 'fa-file';
        $submenu7->url = 'in-report';
        $submenu7->id_menu = $laporan;
        $submenu7->save();
        $submenu7->status()->attach($admin);
        $submenu7->status()->attach($manager);
        $submenu7->status()->attach($kasir);

        $submenu8 = new Submenu();
        $submenu8->title = 'Item Keluar';
        $submenu8->icon = 'fa-file-o';
        $submenu8->url = 'out-report';
        $submenu8->id_menu = $laporan;
        $submenu8->save();
        $submenu8->status()->attach($admin);
        $submenu8->status()->attach($manager);
        $submenu8->status()->attach($kasir);
    }
}
