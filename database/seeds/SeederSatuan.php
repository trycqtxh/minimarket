<?php

use Illuminate\Database\Seeder;

class SeederSatuan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuan1 = new \App\ProdukSatuan();
        $satuan1->nama = 'BKS';
        $satuan1->keterangan = 'Bungkus';
        $satuan1->save();

        $satuan1 = new \App\ProdukSatuan();
        $satuan1->nama = 'DUS';
        $satuan1->keterangan = null;
        $satuan1->save();

        $satuan1 = new \App\ProdukSatuan();
        $satuan1->nama = 'LSN';
        $satuan1->keterangan = null;
        $satuan1->save();

        $satuan1 = new \App\ProdukSatuan();
        $satuan1->nama = 'PAK';
        $satuan1->keterangan = null;
        $satuan1->save();

        $satuan1 = new \App\ProdukSatuan();
        $satuan1->nama = 'PCS';
        $satuan1->keterangan = null;
        $satuan1->save();


    }
}
