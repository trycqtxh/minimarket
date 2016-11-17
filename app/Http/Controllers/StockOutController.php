<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukDetail;
use App\ProdukKeluar;
use App\Transformers\ProdukKeluarTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Spatie\Fractal\ArraySerializer;

class StockOutController extends Controller
{
    public function index()
    {
        return view('stockout');
    }

    public function create(Requests\StockRequest $request, ProdukKeluar $keluar, Produk $produk)
    {
        try{

            $id_produk = $produk->where('kode', $request->kode)->pluck('id')->first();

            $keluar = $keluar->create([
                //'tanggal' => $request->tanggal,
                'stok' => $request->stok,
                'id_produk' => $id_produk,
                'id_produk_detail' => $request->detailitem,
                //'id_user' => Auth::user()->id
            ]);
            if($keluar){
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => 'Berhasil ditambahkan',
                        'text' => $request->kode
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => 'Berhasil ditambahkan',
                        'text' => $request->kode
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->getMessage(),
                    'text' => $e->getSql()
                ], 501);
        }
    }

    public function show(ProdukKeluar $keluar)
    {
        $keluar = $keluar->orderByTanggalDesc()->get();

        return fractal()
            ->collection($keluar)
            ->transformWith(new ProdukKeluarTransformer())
            ->toArray();
    }

    public function caridetailitem(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $detail = new ProdukDetail();

        $resource = new Collection($detail->whereIn('status', ['2', '3'])->get()->toArray(), function(array $dp){
            return [
                'id'        => $dp['id'],
                'nama'      => $dp['nama'],
                'deskripsi' => $dp['deskripsi'],
            ];
        });

        $json = $manager->createData($resource)->toArray();

        $filtered = $json;
        if(strlen($q)) {
            $filtered = array_filter($json, function ($val) use ($q) {
                if (stripos($val['nama'], $q) !== false) {
                    return true;
                } else {
                    return false;
                }
            });
        }

        echo json_encode(array_slice(array_values($filtered), 0, 20));
    }
}
