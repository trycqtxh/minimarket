<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
            'deskripsi' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute tidak boleh kosong'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'telepon' => 'Telepon',
            'alamat' => 'Alamat',
            'deskripsi' => 'Deskripsi'
        ];
    }
}
