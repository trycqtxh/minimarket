<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukDetail extends Model
{
    protected $table = 'produk_detail';
    public $timestamps = false;
    protected $fillable = ['id', 'nama', 'deskripsi'];

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'id_detail_produk');
    }

    public function produkkeluars()
    {
        return $this->hasMany(ProdukKeluar::class, 'id_detail_produk');
    }
}
