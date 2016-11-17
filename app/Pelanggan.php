<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    //public $timestamps = false;
    protected $fillable = ['nama', 'jenis_kelamin', 'telepon', 'alamat'];
    protected $appends = ['jenis', 'action'];
    protected $hidden = ['id', 'jenis_kelamin', 'created_at', 'updated_at'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }

    public function getJenisAttribute()
    {
        return ($this->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan';
    }

    public function getActionAttribute()
    {
        return $this->attributes['action'] = '
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" id="btn-edit" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-jk="'.$this->jenis_kelamin.'" data-tlp="'.$this->telepon.'" data-alamat="'.$this->alamat.'"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-jk="'.$this->jenis_kelamin.'" data-tlp="'.$this->telepon.'" data-alamat="'.$this->alamat.'"><i class="fa fa-trash"></i></button>
			</div>
		';
    }

}
