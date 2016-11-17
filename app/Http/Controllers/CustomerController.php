<?php

namespace App\Http\Controllers;

use App\Transformers\PelangganTranformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use App\Pelanggan;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer');
    }

    //Tambah
    public function create(CustomerRequest $request, Pelanggan $pelanggan)
    {
        try{
            $result = $pelanggan->create([
                'id' => $request->id,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat
            ], 201);

            if($result){
                return Response()->json([
                    'type' => 'success',
                    'title' => 'Berhasil ditambahkan',
                    'text' => $request->nama
                ], 201);
            }else{
                return Response()->json([
                    'type' => 'error',
                    'title' => 'Gagal Ditambahkan',
                    'text' => $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type' => 'error',
                'title' => $e->errorInfo,
                'text' => $e->getMessage()
            ], 501);
        }
    }

    //Table
    public function show(Pelanggan $pelanggan)
    {
        try{
            $pelanggan = $pelanggan->all();
            return fractal()
                ->collection($pelanggan)
                ->transformWith(new PelangganTranformer)
                ->toArray();
        }catch (QueryException $e){
            return Response()->json([
                'type' => 'error',
                'title' => $e->errorInfo,
                'text' => $e->getMessage()
            ], 501);
        }
    }

    //Edit
    public function update(CustomerRequest $request, Pelanggan $pelanggan)
    {
        try{
            $update = $pelanggan->findOrFail($request->id);

            $update->nama = $request->nama;
            $update->jenis_kelamin = $request->jenis_kelamin;
            $update->alamat = $request->alamat;
            $update->telepon = $request->telepon;

            if($update->save()){
                return Response()->json([
                    'type' => 'success',
                    'title' => 'Berhasil diubah',
                    'text' => $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type' => 'error',
                    'title' => 'Gagal diubah',
                    'text' => $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type' => 'error',
                'title' => $e->errorInfo,
                'text' => $e->getMessage()
            ], 501);
        }
    }

    //Hapus
    public function destroy(Request $request, Pelanggan $pelanggan)
    {
        try{
            $pelanggan = $pelanggan->findOrFail($request->id);
            if($pelanggan->delete()){
                return Response()->json([
                    'type' => 'success',
                    'title' => 'Berhasil dihapus',
                    'text' => $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type' => 'error',
                    'title' => 'Gagal dihapus',
                    'text' => $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type' => 'error',
                'title' => $e->errorInfo,
                'text' => $e->getMessage()
            ], 501);
        }

    }
}
