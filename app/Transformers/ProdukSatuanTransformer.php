<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 14:55
 */

namespace App\Transformers;


use App\ProdukSatuan;
use League\Fractal\TransformerAbstract;

class ProdukSatuanTransformer extends TransformerAbstract
{
    public function transform(ProdukSatuan $ps)
    {
        return [
            'nama' => $ps->nama,
            'keterangan' => $ps->keterangan,
            'action' => $ps->action,
        ];
    }
}