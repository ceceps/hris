<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KartuKeluargaRequest extends FormRequest
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
            'nokk' => request()->route('kartukeluargas')
            ?'required|string|max:30|unique:kartu_keluargas,nokk,'.request()->route('kartukeluargas'):
            'required|string|max:30|unique:kartu_keluargas,nokk',
            'fotokk' =>  request()->route('kartukeluargas')?'image|mimes:jpeg,jpg,png|max:10246'.request()->route('kartukeluargas'):'image|mimes:jpeg,jpg,png|max:10246',
            'tgl_keluar' => 'required|date',
        ];
    }
}
