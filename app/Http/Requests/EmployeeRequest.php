<?php

namespace App\Http\Requests;

use App\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'nik' => 'required',
            'noktp' => (request()->id > 0)
                ? 'required|string|max:30|unique:employees,noktp,' . request()->id
                : 'required|string|max:30|unique:employees,noktp',
            'attendance_id' => (request()->id > 0)
                ? 'required|string|max:30|unique:employees,attendance_id,' . request()->id
                : 'required|string|max:30|unique:employees,attendance_id',
            'place_birth' => 'required',
            'birthday' => 'required',
            'name'   => 'required',
            'email'   => (request()->id > 0)? 'required|email|unique:employee,email,'.request()->id
                          :'required|email|unique:employee,email',
            'work_phone'    => 'nullable|max:20',
            'mobile_phone'  => 'nullable|max:20',
            'ptkp_id'  => 'nullable|max:20',
            'jurnal_id'  => 'nullable|max:20',
            'bank_account' => 'nullable|max:20',
            'bpjs_tenagakerja' => 'nullable|max:20',
            'bpjs_kesehatan' => 'nullable|max:20',
            'postalcode' => 'required',
            'join_date' => 'required',
            'job_id' => 'required',
            'job_level_id' => 'required',
            'grade' => 'required',
            'salary_role'  => 'required',
            'category_id'  => 'required',
            'status'  => 'required',
            'religion'  => 'required',
            'gender'  => 'required',
            'marital' => 'required',
            'education'  => 'required',
            'email' => 'required',
            'foto' => 'nullable',
            'foto_ktp' => 'nullable',
            'foto_npwp' => 'nullable',
            'is_wafat' => 'nullable',
        ];
    }

    public function dataEmployee()
    {
        return [
            'name'        => $this->name,
            'place_birth' => $this->place_birth,
            'birthday'    => Carbon::parse($this->birthday),
            'nik'         => $this->nik,
            'noktp'       => $this->noktp,
            'category_id' => $this->category_id,
            'job_id'      => $this->job_id,
            'job_level_id' => $this->job_level_id,
            'departement_id' => $this->departement_id,
            'attendance_id' => $this->attendance_id,
            'grade'       => $this->grade,
            'gender'      => $this->gender,
            'join_date'   => Carbon::parse($this->join_date),
            'resign_date'   => Carbon::parse($this->resign_date),
            'status'      => $this->status,
            'marital'     => $this->marital,
            'mobile_phone' => $this->mobile_phone,
            'work_phone'   => $this->work_phone,
            'education'    => $this->education,
            'email'        => $this->email,
            'salary_role'  => str_replace('.','',Helpers::left($this->salary_role,strlen($this->salary_role)-3)),
            'ptkp_id'      => $this->ptkp_id,
            'jurnal_id'    => $this->jurnal_id,
            'bank_account' => $this->bank_account,
            'bank_id'      => $this->bank_id,
            'bpjs_tenagakerja' => $this->bpjs_tenagakerja,
            'bpjs_kesehatan' => $this->bpjs_kesehatan,
            'update_by'    => auth()->user()->id,
        ];
    }
}
