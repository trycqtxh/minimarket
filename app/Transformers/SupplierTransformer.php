<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 06/10/2016
 * Time: 19:06
 */

namespace App\Transformers;


use App\Supplier;
use League\Fractal\TransformerAbstract;

class SupplierTransformer extends TransformerAbstract
{
    public function transform(Supplier $supplier)
    {
        return [
            'nama' => $supplier->nama,
            'alamat' => $supplier->alamat,
            'telepon' => $supplier->telepon,
            'deskripsi' => $supplier->deskripsi,
            'action' => $supplier->action
        ];
    }
}