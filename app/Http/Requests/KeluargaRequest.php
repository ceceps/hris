<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class KeluargaRequest extends FormRequest
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
            'kartu_keluarga_id' => ( request()->id>0)?'required|numeric':'nullable',
            'nokk' => 'required',
            'tgl_keluar' => 'required',
            'fotokk'  => 'nullable|image|mimes:png,jpg,jpeg|max:5096', //max 5MB
            'noktp' => ( request()->id>0)
                ? 'required|string|max:30|unique:anggotas,noktp,'.request()->id
                : 'required|string|max:30|unique:anggotas,noktp',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'rt' => 'nullable|max:3',
            'rw' => 'nullable|max:3',
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'village_id' => 'nullable|numeric',
            'kodepos' => 'nullable|string|min:5|max:5',
            'unit_id' => 'required',
        ];
    }

    public function dataKartuKeluarga()
    {
        return [
            'nokk' => $this->nokk,
            'tgl_keluar' => Carbon::parse($this->tgl_keluar),
            'update_by' =>  auth()->user()->id,
        ];
    }

    public function dataAnggota()
    {
        return [
            'noktp' => $this->noktp,
            'name' => $this->name,
            'jk' => $this->jk,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' =>   date('Y-m-d', strtotime($this->tgl_lahir)),
            'jabatan_keluarga' => 'Kepala Keluarga',
            'alamat' =>  $this->alamat,
            'rt' =>  $this->rt,
            'rw' => $this->rw,
            'agama' => $this->agama,
            'status_nikah' => $this->status_nikah,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'district_id' =>  $this->district_id,
            'village_id' =>  $this->village_id,
            'kodepos' =>  $this->kodepos,
            'update_by' =>  auth()->user()->id,
        ];
    }

    public function dataKeluarga()
    {
        return [
            'kode_kel' => uniqid(),
            'noktp' => $this->noktp,
            'name' => $this->name,
            'jk' => $this->jk,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' =>  date('Y-m-d', strtotime($this->tgl_lahir)),
            'alamat' =>  $this->alamat,
            'rt' =>  $this->rt,
            'rw' => $this->rw,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'district_id' =>  $this->district_id,
            'village_id' =>  $this->village_id,
            'kodepos' =>  $this->kodepos,
            'update_by' =>  auth()->user()->id,
            'unit_id' =>  $this->unit_id,
        ];
    }
}
