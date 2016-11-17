<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukSatuan extends Model
{
    protected $table = 'produk_satuan';
    public $timestamps = false;
    protected $fillable = ['nama', 'keterangan'];
    protected $appends = ['action'];
    //protected $hidden = ['id'];
    //protected $visible  = ['nama', 'keterangan', 'id'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_satuan');
    }

    public function getActionAttribute()
    {
        return $this->attributes['action'] = '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-keterangan="'.$this->keterangan.'" id="btn-edit"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-keterangan="'.$this->keterangan.'" id="btn-delete"><i class="fa fa-trash"></i></button>
			</div>
		';
    }
}
