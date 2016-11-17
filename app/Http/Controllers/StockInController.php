<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukDetail;
use App\ProdukMasuk;
use App\Supplier;
use App\Transformers\ProdukMasukTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\StockRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Spatie\Fractal\ArraySerializer;

class StockInController extends Controller
{
    public function index()
    {
        return view('stockin');
    }

    public function create(StockRequest $request, ProdukMasuk $masuk, Produk $produk)
    {
        try{
            $id_produk = $produk->where('kode', $request->kode)->pluck('id')->first();
            $result = $masuk->create([
                'tanggal' => $request->tanggal,
                'stok' => $request->stok,
                'id_produk' => $id_produk,
                'id_produk_detail' => $request->detailitem,
                'id_user' => Auth::user()->id,
                'id_supplier' => ($request->supplier) ? $request->supplier : null
            ]);
            if($result){
                return Response()
                    ->json([
                        'type'=> 'success',
                        'title' => 'Berhasil ditambahkan',
                        'text' => $request->tanggal." ".$request->stok." ".$request->id_produk
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type'=> 'error',
                        'title' => 'Gagal ditambahkan',
                        'text' => $request->tanggal." ".$request->stok." ".$request->id_produk
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => '',
                    'text' => $e->getMessage()
                ], 501);
        }

    }

    public function show(ProdukMasuk $pm)
    {
        $pm = $pm->orderByTanggalDesc()->get();

        return fractal()
            ->collection($pm)
            ->transformWith(new ProdukMasukTransformer())
            ->toArray();
    }

    public function caridetailitem(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $detail = new ProdukDetail();

        $resource = new Collection($detail->whereIn('status', ['1', '3'])->get()->toArray(), function(array $dp){
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

    public function carisupplier(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $supplier = new Supplier();


        $resource = new Collection($supplier->all()->toArray(), function(array $supplier){
            return [
                'id'        => $supplier['id'],
                'nama'      => $supplier['nama'],
                'deskripsi' => $supplier['deskripsi'],
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
