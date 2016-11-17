<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 13:57
 */

namespace App\Transformers;


use App\Produk;
use League\Fractal\TransformerAbstract;

class ProdukTransformer extends TransformerAbstract
{
    public function transform(Produk $product)
    {
        return [
            'kode' => $product->kode,
            'nama' => $product->nama,
            'harga' => "Rp.".number_format($product->harga,2,',','.'),
            'stok' => $product->stok,
            'category' => $product->kategori->nama,
            'unit' => $product->satuan->nama,
            'action' => $product->action,
        ];
    }
}