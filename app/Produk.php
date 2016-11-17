<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = false;
    protected $fillable = ['kode', 'nama', 'harga', 'deskripsi', 'id_kategori', 'id_satuan'];
    public $hidden = ['id_kategori', 'id', 'id_satuan', 'deskripsi'];
    //protected $primaryKey = 'kode';
    protected $appends = ['action', 'pilih', 'stok'];

    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'id_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(ProdukSatuan::class, 'id_satuan');
    }

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'id_produk');
    }

    public function produkkeluars()
    {
        return $this->hasMany(ProdukKeluar::class, 'id_produk');
    }

    public function transaksidetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk');
    }

    public function getStokAttribute()
    {
        return intval($this->produkmasuks()->sum('stok') -  $this->produkkeluars()->sum('stok'));
    }

    public function getActionAttribute()
    {
        return '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-id="'.$this->id.'" data-kode="'.$this->kode.'" data-nama="'.$this->nama.'" data-harga="'.$this->harga.'" data-deskripsi="'.$this->deskripsi.'" data-kategori="'.$this->id_kategori.'" data-satuan="'.$this->id_satuan.'" id="btn-edit"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger" data-id="'.$this->id.'" data-kode="'.$this->kode.'" data-nama="'.$this->nama.'" data-harga="'.$this->harga.'" id="btn-delete"><i class="fa fa-trash"></i></button>
			</div>
		';
    }

    public function getPilihAttribute()
    {
        return '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" onclick="pilih('."'".$this->kode."'".', '."'".$this->nama."'".', '."'".$this->harga."'".', '."'".$this->stok."'".')"><i class="fa fa-arrow-down"></i></button>
			</div>
		';
    }

}
