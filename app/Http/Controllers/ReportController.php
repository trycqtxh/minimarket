<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukKeluar;
use App\ProdukMasuk;
use App\Transaksi;
use App\Transformers\ProdukKeluarTransformer;
use App\Transformers\ProdukMasukTransformer;
use App\Transformers\TransaksiTransformer;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        return view('reportsales');
    }
    public function datareportsales(Request $request, Transaksi $transaksi)
    {

        if($request->tanggal){
            $tanggal = explode('#', $request->tanggal);
            $transaksi = $transaksi->where('tanggal', '>=', $tanggal[0])->where('tanggal', '<=', $tanggal[1])->get();
        }else{
            $transaksi = $transaksi->all();
        }

        return fractal()
            ->collection($transaksi)
            ->transformWith(new TransaksiTransformer())
            ->includeItems()
            ->toArray();
    }

    public function salesexcel()
    {
        $sales = new Users();
        $sales = $sales->all()->toArray();
        Excel::create('reposetsales', function($excel) use ($sales){
            $excel->setTitle('Laporan Penjualan');

            $excel->sheet('laporan', function($sheet) use ($sales){
//                $sheet->setPageMargin(array(
//                    0.25, 0.30, 0.25, 0.30
//                ));
                $sheet->setOrientation('landscape');
                $sheet->fromArray($sales, null, 'A1', true);

            });
        })->export('xlsx');
    }
    public function stockin()
    {
        return view('reportstockin');
    }

    public function datareportstockin(ProdukMasuk $pm)
    {
        $masuk = $pm->orderByTanggalDesc()->get();

        return fractal()
            ->collection($masuk)
            ->transformWith(new ProdukMasukTransformer())
            ->toArray();
    }

    public function stockout()
    {
        return view('reportstockout');
    }

    public function datareportstockout(ProdukKeluar $keluar)
    {
        $keluar = $keluar->orderByTanggalDesc()->get();

        return fractal()
            ->collection($keluar)
            ->transformWith(new ProdukKeluarTransformer())
            ->toArray();
    }

}
