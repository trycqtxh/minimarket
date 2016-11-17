<?php

namespace App\Http\Controllers;

use App\ProdukSatuan;
use App\Transformers\ProdukSatuanTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\UnitRequest;
use Illuminate\Http\Response;
use Mockery\CountValidator\Exception;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UnitRequest $request, ProdukSatuan $produkSatuan)
    {
        try{
            $produkSatuan->create([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]);
            if($produkSatuan){
                return Response()->json([
                    'type'=>'success',
                    'title'=>'Berhasil ditambahkan',
                    'text'=> $request->nama
                ], 201);
            }else{
                return Response()->json([
                    'type'=>'error',
                    'type'=>'Gagal Ditambahkan',
                    'text'=> $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type'=>'error',
                'text'=> $e->getMessage()
            ], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukSatuan $satuan)
    {
        $units = $satuan->all();

        return fractal()
            ->collection($units)
            ->transformWith(new ProdukSatuanTransformer())
            ->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukSatuan $satuan)
    {
        try{
            $update = $satuan->findOrFail($request->id);
            $update->nama = $request->nama;
            $update->keterangan = $request->keterangan;

            if($update->save()){
                return Response()->json([
                    'type'=>'success',
                    'title'=>'Berhasil dihapus',
                    'text'=> $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type'=>'error',
                    'title'=>'Gagal diubah',
                    'text'=> $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type'=>'error',
                'text'=> $e->getMessage()
            ], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProdukSatuan $ps)
    {
        try{
            $produk = $ps->findOrFail($request->id);
            if($produk->delete()){
                return Response()->json([
                    'type'=>'success',
                    'title'=>'Berhasil ditambahkan',
                    'text'=> $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type'=>'error',
                    'title'=> 'Gagal ditambahkan',
                    'text'=> $request->nama
                ], 406);
            }
        }catch (QueryException $e) {
            return Response()->json([
                'type' => 'error',
                'title' => $e->errorInfo,
                'text' => $e->getMessage()
            ], 501);
        }
    }
}
