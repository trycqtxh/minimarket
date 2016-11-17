<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 21:54
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;
use App\ProdukMasuk;

class ProdukMasukTransformer extends TransformerAbstract
{
    public function transform(ProdukMasuk $masuk)
    {
        return [
            'tanggal' => $masuk->tanggal,
            'stok' => $masuk->stok,
            'kode' => $masuk->produk->kode,
            'nama' => $masuk->produk->nama,
            'detail' => $masuk->produkdetail->nama,
            'supplier' => (!$masuk->id_supplier) ? '' : $masuk->supplier->nama,
        ];
    }
}