<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Users extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $hidden = ["password", "remember_token"];
    protected $fillable = ['nama', 'username', 'password', 'id_status'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'id_user');
    }

    public function produkkeluars()
    {
        return $this->belongsTo(ProdukKeluar::class, 'id_user');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }

    public function getActionAttribute()
    {
        return $this->attributes['action'] =
            '
            <div class="btn-group pull-right">
				<button type="button" class="btn btn-sm btn-primary" onclick="edit('.$this->id.', '."'".$this->nama."'".')"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-sm btn-danger" onClick="hapus('.$this->id.', '."'".$this->nama."'".')"><i class="fa fa-trash"></i></button>
			</div>
            ';
    }
}
