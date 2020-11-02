<?php

namespace App\Http\Requests;

use App\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
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
            'job_id' => 'required',
            'employee_id' => 'required',
            'periode_from' => 'required',
            'periode_to' => 'required',
            'tgl_cetak' => 'nullable',
            'uang_pokok' => 'required',
            'uang_lembur' => 'nullable',
            'uang_makan' => 'nullable',
            'tunj_keluarga' => 'nullable',
            'tunj_haritua' => 'nullable',
            'tunj_kesehatan' => 'nullable',
            'tunj_keselamatan' => 'nullable',
            'tunj_kecelakaan' => 'nullable',
            'tunj_hari_raya' => 'nullable',
            'bonus' => 'nullable',
            'potongan_listrik' => 'nullable',
            'potongan_belanja' => 'nullable',
            'potongan_koperasi' => 'nullable',
            'potongan_lain' => 'nullable',
            'gaji_kotor' => 'required',
            'total_upah' => 'required',
        ];
    }

    public function data()
    {
        return [
            'job_id' => $this->job_id,
            'employee_id' =>  $this->employee_id,
            'periode_from' =>  Carbon::parse($this->periode_from),
            'periode_to' => Carbon::parse($this->periode_to),
            'tgl_cetak' =>  Carbon::now(),
            'uang_pokok' => str_replace('.','',$this->uang_pokok),
            'uang_lembur' => Helpers::realNumber($this->uang_lembur),
            'uang_makan' => Helpers::realNumber($this->uang_makan),
            'tunj_keluarga' =>  Helpers::realNumber($this->tunj_keluarga),
            'tunj_haritua' =>  Helpers::realNumber($this->tunj_haritua),
            'tunj_kesehatan' =>  Helpers::realNumber($this->tunj_kesehatan),
            'tunj_keselamatan' =>  Helpers::realNumber($this->tunj_keselamatan),
            'tunj_kecelakaan' =>  Helpers::realNumber($this->tunj_kecelakaan),
            'tunj_hari_raya' =>  Helpers::realNumber($this->tunj_hari_raya),
            'bonus' =>  Helpers::realNumber($this->bonus),
            'potongan_listrik' =>  Helpers::realNumber($this->potongan_listrik),
            'potongan_belanja' =>  Helpers::realNumber($this->potongan_belanja),
            'potongan_koperasi' =>  Helpers::realNumber($this->potongan_koperasi),
            'potongan_lain' =>  Helpers::realNumber($this->potongan_lain),
            'gaji_kotor' =>  str_replace('.','',$this->gaji_kotor),
            'total_upah' => str_replace('.','',$this->total_upah),
            'update_by' => auth()->user()->id,
        ];
    }
}
