<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukKategori;
use App\ProdukSatuan;
use App\Transformers\ProdukSatuanTransformer;
use App\Transformers\ProdukTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Spatie\Fractal\ArraySerializer;

class ProductController extends Controller
{
    public function index()
    {
        return view('product');
    }
    
    public function create(ProductRequest $request, Produk $produk)
    {
        try{
            $product = $produk->create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'id_kategori' => $request->kategori,
                'id_satuan' => $request->satuan
            ]);

            if($product){
                return Response()
                    ->json([
                        'type'=> 'success',
                        'title'=> 'Berhasil ditambahkan',
                        'text'=>  $request->nama
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type'=> 'error',
                        'title'=> 'Gagal ditambahkan',
                        'text'=>  $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type'=> 'error',
                    'title'=> 'Gagal ditambahkan',
                    'text'=>  $e->getMessage()
                ], 501);
        }
    }
    
    public function productpilih(Produk $produk)
    {
        $product = $produk->get()->sortByDesc('stok');

        return fractal()
            ->collection($product)
            ->transformWith(function($product){
                return [
                    'kode' => $product->kode,
                    'nama' => $product->nama,
                    'harga' => "Rp " . number_format($product->harga,2,',','.'),
                    'stok' => $product->stok,
                    'pilih' => $product->pilih,
                ];
            })
            ->toArray();
    }
    
    public function show(Produk $produk)
    {
        $product = $produk->get()->sortByDesc('stok');

        return fractal()
            ->collection($product)
            ->transformWith(new ProdukTransformer())
            ->toArray();
    }

    public function cari(Request $request, Produk $produk)
    {
        $produk = $produk->where('kode', $request->kode);
        //dd($produk);
        if($produk->count() == 1){
            return Response()
                ->json([
                    'type' => 'success',
                    'title' => '',
                    'text' => $request->kode.' ada dalam data base',
                ], 200);
        }else if($produk->count() == null){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => '',
                    'text' => $request->kode.' tidak ada dalam database',
                ], 200);
        }
    }

    public function update(Request $request, Produk $product)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required:numeric',
            'deskripsi' => 'nullable',
        ]);
        try{
            $product = $product->findOrFail($request->id);

            $product->kode = $request->kode;
            $product->nama = $request->nama;
            $product->harga = $request->harga;
            $product->deskripsi = $request->deskripsi;
            $product->id_kategori = ($request->kategori) ?  $request->kategori : $product->id_kategori;
            $product->id_satuan = ($request->satuan) ? $request->satuan : $product->id_satuan;

            if($product->save()){
                return Response()
                    ->json([
                        'type'=> 'success',
                        'title'=> 'Berhasil diubah',
                        'text'=>  $request->nama
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type'=> 'error',
                        'title'=> 'Gagal diubah',
                        'text'=>  $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type'=> 'error',
                    'title'=> 'Gagal diubah',
                    'text'=>  $e->getMessage()
                ], 501);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $product = Produk::where('kode', $request->kode)->first();

            if($product->delete()){
                return Response()
                    ->json([
                        'type'=> 'success',
                        'title'=> 'Berhasil dihapus',
                        'text'=>  $request->nama
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type'=> 'error',
                        'title'=> 'Gagal dihapus',
                        'text'=>  $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type'=> 'error',
                    'title'=> 'Gagal dihapus',
                    'text'=>  $e->getMessage()
                ], 501);
        }
    }

    public function carisatuan(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $satuan = new ProdukSatuan();

        $resource = new Collection($satuan->all()->toArray(), function(array $book) {
            return [
                'id'        => $book['id'],
                'nama'      => $book['nama'],
                'keterangan'=> $book['keterangan'],
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

    public function carikategori(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $kategori = new ProdukKategori();

        $resource = new Collection($kategori->all()->toArray(), function(array $book) {
            return [
                'id'      => $book['id'],
                'nama'      => $book['nama'],
                'keterangan'   => $book['keterangan'],
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
