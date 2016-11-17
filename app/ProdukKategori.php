<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    protected $table = 'produk_kategori';
    public $timestamps = false;
    protected $fillable = ['nama', 'keterangan'];
    protected $appends = ['action'];
    //protected $hidden = ['id'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }

    public function getActionAttribute()
    {
        return $this->attributes['action'] = '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" id="btn-edit" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-ket="'.$this->keterangan.'"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-ket="'.$this->keterangan.'"><i class="fa fa-trash"></i></button>
			</div>
		';
    }
}
