<?php

namespace App\Http\Controllers;

use App\Transformers\ProdukKategoriTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use App\ProdukKategori;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRequest $request, ProdukKategori $kategori)
    {
        try{
            $kategori =$kategori->create([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]);
            if($kategori){
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => 'Berhasil Ditambahkan',
                        'text' => $request->nama.', '.$request->keterangan
                    ], 201);
            }else{
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => 'Gagal Ditambahkan',
                        'text' => $request->nama.', '.$request->keterangan
                    ], 406);
            }
        }catch (QueryException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->errorInfo,
                    'text' => $e->getMessage()
                ], 501 );
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
    public function show(ProdukKategori $kategori)
    {
        $kategori = $kategori->all();

        return fractal()
            ->collection($kategori)
            ->transformWith(new ProdukKategoriTransformer)
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
    public function update(Request $request, ProdukKategori $kategori)
    {
        try{
            $category = $kategori->findOrFail($request->id);
            $category->nama = $request->nama;
            $category->keterangan = $request->keterangan;
            if($category->save()){
                return Response()->json([
                    'type'=>'success',
                    'title'=> 'Berhasil Diubah',
                    'text'=> $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type'=>'error',
                    'title'=>'Gagal Diubah',
                    'text'=> $request->nama
                ], 406);
            }
        }catch (QueryException $e){
            return Response()->json([
                'type'=>'error',
                'title'=>$e->errorInfo,
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
    public function destroy(Request $request, ProdukKategori $kategori)
    {
        try{
            $category = $kategori->findOrFail($request->id);
            if($category->delete()){
                return Response()->json([
                    'type' => 'success',
                    'title' => 'Berhasil Dihapus',
                    'text' => $request->nama
                ], 202);
            }else{
                return Response()->json([
                    'type' => 'error',
                    'title' => 'Gagal Dihapus',
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
