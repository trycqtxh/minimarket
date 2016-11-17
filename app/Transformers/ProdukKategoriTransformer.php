<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 14:17
 */

namespace App\Transformers;


use App\ProdukKategori;
use League\Fractal\TransformerAbstract;

class ProdukKategoriTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'actions'
    ];

    public function transform(ProdukKategori $pk)
    {
        return [
            'nama' => $pk->nama,
            'keterangan' => $pk->keterangan,
            'action' => $pk->action,
        ];
    }

}