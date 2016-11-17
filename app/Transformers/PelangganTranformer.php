<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 19:01
 */

namespace App\Transformers;


use App\Pelanggan;
use League\Fractal\TransformerAbstract;

class PelangganTranformer extends TransformerAbstract
{
    public function transform(Pelanggan $pelanggan)
    {
        return [
            'nama' => $pelanggan->nama,
            'jenis_kelamin' => $pelanggan->jenis,
            'telepon' => $pelanggan->telepon,
            'alamat' => $pelanggan->alamat,
            'action' => $pelanggan->action,
        ];
    }
}