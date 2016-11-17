<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukKeluar extends Model
{
    protected $table = 'produk_keluar';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'stok', 'id_produk', 'id_produk_detail', 'id_user'];
    protected $appends = ['namaproduk', 'produkdetail', 'kodeproduk'];
    protected $hidden = ['id', 'id_produk', 'id_produk_detail', 'id_user'];

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

    public function scopeOrderByTanggalDesc($query)
    {
        return $query->orderBy('tanggal', 'DESC');
    }

}
