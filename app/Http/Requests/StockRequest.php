<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'tanggal' => 'nullable',
            'kode' => 'required|exists:produk,kode',
            'detailitem' => 'required',
            'supplier' => 'nullable',
            'stok' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute harus angka',
            'exists' => ':attribute tidak ada dalam database',
        ];
    }

    public function attributes()
    {
        return [
            'tanggal' => 'Tanggal',
            'kode' => 'Kode Item',
            'detailitem' => 'Detail Item',
            'supplier' => 'Supplier',
            'stok' => 'Stok'
        ];
    }
}
