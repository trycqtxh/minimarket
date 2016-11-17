<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DateTime;
class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;
    protected $fillable = ['kode', 'tanggal', 'id_pelanggan', 'id_user'];
    protected $primary = 'kode';
    //protected $appends = ['nota', 'tanggaltransaksi'];

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function transaksidetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksi', 'id_transaksi', 'id_produk');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $dt = new DateTime;
            $model->tanggal = $dt->format('m-d-y H:i:s');
            return true;
        });
//		static::saving(function($model){
//
//		});
    }
}
