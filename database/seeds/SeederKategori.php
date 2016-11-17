<?php

use Illuminate\Database\Seeder;

class SeederKategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori1 = new \App\ProdukKategori();
        $kategori1->nama = 'ART';
        $kategori1->keterangan = null;
        $kategori1->save();

        $kategori2 = new \App\ProdukKategori();
        $kategori2->nama = 'ATK';
        $kategori2->keterangan = 'Alat Tulis Kantor';
        $kategori2->save();

        $kategori3 = new \App\ProdukKategori();
        $kategori3->nama = 'LL';
        $kategori3->keterangan = null;
        $kategori3->save();

        $kategori4 = new \App\ProdukKategori();
        $kategori4->nama = 'MKN';
        $kategori4->keterangan = 'Makanaan';
        $kategori4->save();

        $kategori5 = new \App\ProdukKategori();
        $kategori5->nama = 'MNM';
        $kategori5->keterangan = 'Minuman';
        $kategori5->save();

        $kategori6 = new \App\ProdukKategori();
        $kategori6->nama = 'OBT';
        $kategori6->keterangan = 'Obat';
        $kategori6->save();

    }
}
