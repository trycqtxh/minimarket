<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    //public $timestamps = false;
    protected $fillable = ['id', 'nama', 'alamat', 'telepon', 'deskripsi'];
    protected $appends = ['action'];
    protected $hidden = ['created_at', 'updated_at'];

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'id_supplier');
    }

    public function getActionAttribute()
    {
        return $this->attributes['action'] = '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-telepon="'.$this->telepon.'" data-alamat="'.$this->alamat.'" data-deskripsi="'.$this->deskripsi.'" id="btn-edit"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger"  data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-telepon="'.$this->telepon.'" data-alamat="'.$this->alamat.'" data-deskripsi="'.$this->deskripsi.'" id="btn-delete"><i class="fa fa-trash"></i></button>
			</div>
		';
    }
}
