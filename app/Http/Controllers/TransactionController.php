<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukKeluar;
use App\Transaksi;
use App\TransaksiDetail;
use Carbon\Carbon;
use Faker\Provider\tr_TR\DateTime;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Spatie\Fractal\ArraySerializer;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TransactionController extends Controller
{

    public function index()
    {
        return view('transaction');
    }

    public function getKodeTransaksi()
    {
        $transaksi = new Transaksi();
        $date = Carbon::now();
        $id = $transaksi->max('id');

        return Response()
            ->json([
                'kode' => sprintf('TR'.'%0' . 6 .'s-%s', ($id) ? intval($id) + 1 : 1, $date->format('Y/m/d')),
                'tgl' => $date->format('Y-m-d H:i:s'),
            ], 201);
    }

    public function caribyid(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|exists:produk'
        ]);
        $produk = new Produk();
        $result = $produk->where('kode', $request->kode)->first();
        return fractal()
            ->item($result)
            ->transformWith(function($result){
                return [
                    'kode' => $result->kode,
                    'nama' => $result->nama,
                    'harga' => $result->harga,
                ];
            })->toArray();
    }

    public function bayar(Request $request, Produk $produk)
    {
        $this->validate($request, [
            'bayar' => 'required',
            'kembalian' => 'required',
            'kode_transaksi' => 'required',
        ]);

        $cart = Cart::Content();

        $transaksi = new Transaksi();
//            $transaksi->kode = $request->kode;
//            $transaksi->tanggal = $request->tanggal;
//            $transaksi->id_user = $request->id_user;
        $transaksi->bayar = $request->bayar;
        $transaksi->kembalian = $request->kembalian;
        $transaksi->id_pelanggan = null;//($request->id_pelanggan) ? $request->id_pelanggan : null,
        $transaksi->save();



        foreach($cart as $c)
        {
            $id_produk = $produk->where('kode', $c->id)->first();
            $transaksi->produks()->attach($id_produk, ['qty'=>$c->qty]);
            //$keluar->tanggal = ;
            $keluar = new ProdukKeluar;
            $keluar->stok = $c->qty;
            $keluar->id_produk = $produk->where('kode', $c->id)->pluck('id')->first();
            $keluar->id_produk_detail = 2;//Penjulan id(2) in Database
            //$keluar->id_user = Auth::user()->id;
            $keluar->save();
        }

        Cart::destroy();

        return Response()
            ->json([
                'type' => 'success',
                'title' => 'Berhasil di tambahkan',
                'text' => 'Kode Transaksi : '.$request->kode_transaksi
            ], 201);


    }

    public function addcart(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|exists:produk'
        ]);
        try{
            $data = Cart::add($request->kode, $request->nama, $request->qty, $request->harga);
            return Response()
                ->json([
                    'type' => 'success',
                    'title' => 'Berhasil dimasuk ke Cart',
                    'text' => $request->kode.', '.$request->nama.', '.$request->qty.', '.$request->harga
                ], 201);
        }
        catch (HttpException $e){
            return Response()
                ->json([
                    'type' => 'error',
                    'title' => $e->getHeaders(),
                    'text' => $e->getMessage()
                ], 501);
        }
    }

    public function datacart()
    {
        $cart = Cart::Content();
        return fractal()
            ->collection($cart)
            ->transformWith(function($cart){
                return [
                    'kode' => $cart->id,
                    'nama' => $cart->name,
                    'qty' => $cart->qty,
                    'harga' => $this->curRuliah($cart->price),
                    'subharga' => $this->curRuliah($cart->price * $cart->qty),
                    'action' => '<button class="btn btn-danger btn-xs pull-right" onclick="removeitem('."'".$cart->rowId."'".', '."'".$cart->name."'".')"><i class="fa fa-trash"></i></button>'
                ];
            })
            ->addMeta(['tagihan'=>Cart::subtotal()])
            ->toArray();
    }

    protected function curRuliah($value){
        return "Rp.".number_format($value,2,',','.');
    }

    public function deletecart()
    {
        $data = Cart::destroy();
        return Response()
            ->json([
                'type' => 'success',
                'title' => 'Cart Berhasil di Reset',
                'text' => '',
            ], 201);
    }

    public function removeitem(Request $request)
    {
        $data = Cart::remove($request->rowId);;

        return Response()
            ->json([
                'type' => 'success',
                'title' => 'Berhasil di hapus',
                'text' => $request->nama,
            ], 201);
    }

}
