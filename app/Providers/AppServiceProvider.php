<?php

namespace App\Providers;

use App\ProdukKeluar;
use App\ProdukMasuk;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ProdukMasuk::saving(function($model){
            $date = Carbon::now();

            $model->tanggal = $date->format('Y-m-d H:i:s');
            $model->id_user = Auth::user()->id;
            //return true;
        });

        ProdukKeluar::saving(function($model){
            $date = Carbon::now();

            $model->tanggal = $date->format('Y-m-d H:i:s');
            $model->id_user = Auth::user()->id;
            //return true;
        });

        Transaksi::saving(function($model){
            $transaksi = new Transaksi();
            $date = Carbon::now();
            $id = $transaksi->max('id');

            $model->kode = sprintf('TR'.'%0' . 6 .'s-%s', ($id) ? intval($id) + 1 : 1, $date->format('Y/m/d'));
            $model->tanggal = $date->format('Y-m-d H:i:s');
            $model->id_user = Auth::user()->id;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
