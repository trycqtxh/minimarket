<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\SupplierRequest;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supplier');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SupplierRequest $request, Supplier $supplier)
    {
        try{
            $result = $supplier->create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'deskripsi' => $request->deskripsi
            ]);
            if($result){
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => 'Berhasil ditambahkan',
                        'text' => $request->nama
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => 'Gagal ditambahkan',
                        'text' => $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->errorInfo,
                    'text' => $e->getMessage()
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        try{
            $supplier = $supplier->all();
            return fractal()
                ->collection($supplier)
                ->transformWith(new SupplierTransformer())
                ->toArray();
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->errorInfo,
                    'text' => $e->getMessage()
                ], 501);
        }
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
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        try{
            $update = $supplier->findOrFail($request->id);
            $update->nama = $request->nama;
            $update->alamat = $request->alamat;
            $update->telepon = $request->telepon;
            $update->deskripsi = $request->deskripsi;
            if($update->save()){
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => 'Berhasil diubah',
                        'text' => $request->nama
                    ], 202);
            }else{
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => 'Gagal diubah',
                        'text' => $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->errorInfo,
                    'text' => $e->getMessage(),
                ],501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Supplier $supplier)
    {
        try{
            $supplier = $supplier->findOrFail($request->id);
            if($supplier->delete()){
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => 'Berhasil dihapus',
                        'text' => $request->nama
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => 'Gagal dihapus',
                        'text' => $request->nama
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->errorInfo,
                    'text' => $e->getMessage()
                ], 501);
        }
    }
}
