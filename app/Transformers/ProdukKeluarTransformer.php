<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 23:04
 */

namespace App\Transformers;


use App\ProdukKeluar;
use League\Fractal\TransformerAbstract;

class ProdukKeluarTransformer extends TransformerAbstract
{
    public function transform(ProdukKeluar $keluar)
    {
        return [
            'tanggal' => $keluar->tanggal,
            'stok' => $keluar->stok,
            'kode' => $keluar->produk->kode,
            'nama' => $keluar->produk->nama,
            'detail' => $keluar->produkdetail->nama,
        ];
    }
}