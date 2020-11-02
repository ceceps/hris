<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'kode_unit' =>  request()->id>0
                ? 'required|string|max:20|unique:units,kode_unit,' . request()->id
                : 'required|string|max:20|unique:units,kode_unit',
            'name' => request()->id>0
                ? 'required|string|max:100|unique:units,name,' . request()->id
                : 'required|string|max:100|unique:units,name',
            'tgl_dibentuk' => 'nullable',
            'parent_id' => 'nullable|integer',
        ];
    }
}
