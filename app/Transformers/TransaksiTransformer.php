<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 09/10/2016
 * Time: 9:11
 */

namespace App\Transformers;


use App\Produk;
use App\Transaksi;
use League\Fractal\TransformerAbstract;

class TransaksiTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'items'
    ];
    public function transform(Transaksi $transaksi)
    {
        return [
            'kode' => $transaksi->kode,
            'tanggal' => $transaksi->tanggal,
           // 'item' => $transaksi->tanggal,
            'sub_harga' => "Rp.".number_format($transaksi->bayar,2,',','.'),
            'pelanggan' => ($transaksi->id_pelanggan) ? $transaksi->pelanggan->nama : '',
            'kasir' => $transaksi->user->nama,
            'actions' => '',
        ];
    }

    public function includeItems(Transaksi $transaksi)
    {
        $transaksidetails = $transaksi->transaksidetails;

        return $this->collection($transaksidetails, function($transaksidetails){
            return [
                'nama_item' => $transaksidetails->produk->nama,
                'harga_item' => $transaksidetails->produk->harga,
                'qty_item' => $transaksidetails->qty
            ];
        });

    }
}