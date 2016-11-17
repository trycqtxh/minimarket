<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode' => 'required|unique:produk',
            'nama' => 'required',
            'harga' => 'required:numeric',
            'deskripsi' => 'nullable',
            'kategori' => 'required',
            'satuan' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada dalam database'
        ];
    }

    public function attributes()
    {
        return [
            'kode' => 'Kode / Barcode',
            'nama' => 'Nama',
            'harga' => 'Harga',
            'deskripsi' => 'Deskripsi',
            'kategori' => 'Kategori',
            'satuan' => 'Satuan'
        ];
    }
}
