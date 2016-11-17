<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    protected $table = 'produk_masuk';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'stok', 'id_produk', 'id_produk_detail', 'id_user', 'id_supplier'];
    protected $hidden = ['id', 'id_produk', 'id_produk_detail', 'id_user', 'id_supplier'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function produkdetail()
    {
        return $this->belongsTo(ProdukDetail::class, 'id_produk_detail');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function scopeOrderByTanggalDesc($query)
    {
        return $query->orderBy('tanggal', 'DESC');
    }

}
