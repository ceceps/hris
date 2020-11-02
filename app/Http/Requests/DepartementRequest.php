<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementRequest extends FormRequest
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
            'kode' => request()->id>0?
                      'required|string|max:255|unique:departements,name,'.request()->id:
                    'required|string|max:255|unique:departements,name',
            'name' => request()->id>0?
                      'required|string|max:255|unique:departements,name,'.request()->id:
                    'required|string|max:255|unique:departements,name',
            'parent_id' => 'nullable'
        ];
    }
}
