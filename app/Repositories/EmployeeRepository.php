<?php

namespace App\Repositories;

use App\Helpers\Helpers;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeInterface;
use App\Models\AddressHome;
use App\Models\Attendance;
use App\Traits\ResponseAPI;
use App\Models\Employee;
use App\Models\Job;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeRepository implements EmployeeInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllEmployees($q = '')
    {
        try {
            if ($q != null) {
                $employees = Employee::orderBy('id', 'asc')->where('name', 'ilike', '%' . $q . '%')->get();

                   //count hour in month
                //    if($employees->id){
                //      $attendance = Attendance::where('employee_id',$employees->id)->whereMonth()->get();
                //      $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 3:30:34');
                //      $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 9:30:34');
                //      $diff_in_hours = $to->diffInHours($from);
                //    }

                //   print_r($diff_in_hours);// Output: 6

                $employees->transform(function ($employee) {
                    return [
                        'id' => $employee->id,
                        'text' => $employee->name,
                        'departement' => $employee->departement->kode,
                        'person_id' => $employee->attendance_id,
                        'job_id' => $employee->job_id,
                        'job_name' => $employee->job->name,
                        'job_level_id' => $employee->job_level_id,
                        'job_level' => $employee->jobLevel->name,
                        'grade' => $employee->grade,
                        'salary_role' => number_format($employee->salary_role,0,',','.'),
                    ];
                });
            } else {
                $employees = Employee::orderBy('id', 'asc')->get();
                $employees->transform(function ($employee) {
                    return [
                        'id' => $employee->id,
                        'nik' => $employee->kode_Employee,
                        'name' => $employee->name
                    ];
                });
            }

            if ($employees == null) return $this->error('Data Employee Kosong', 404);
            //    return new EmployeeCollection($employee);
            return $this->success("All Employee", $employees);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }

    // public function employeeBasicFee(Type $var = null)
    // {
    //     if ($q != null) {
    //         $employees = Employee::orderBy('id', 'asc')->where('name', 'ilike', '%' . $q . '%')->get();

    //            //count hour in month
    //            if($employees->id){
    //              $attendance = Attendance::where('employee_id',$employees->id)->whereMonth()->get();
    //              $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 3:30:34');
    //              $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 9:30:34');
    //              $diff_in_hours = $to->diffInHours($from);
    //            }

    //           print_r($diff_in_hours);// Output: 6

    //         $employees->transform(function ($employee) {
    //             return [
    //                 'id' => $employee->id,
    //                 'text' => $employee->name,
    //                 'departement' => $employee->departement->kode,
    //                 'person_id' => $employee->attendance_id,
    //                 'job_id' => $employee->job_id,
    //                 'job_name' => $employee->job->name,
    //                 'job_level_id' => $employee->job_level_id,
    //                 'job_level' => $employee->jobLevel->name,
    //                 'grade' => $employee->grade,
    //                 'salary_role' => number_format($employee->salary_role,0,',','.'),
    //             ];
    //         });
    //         return $this->success('Data Employee Fee',$employees);
    //     }else{
    //         return $this->error('Data Employee Kosong', 404);
    //     }
    // }

    public function EmployeeJson()
    {
        $employees = Employee::orderBy('id');
        return DataTables::of($employees)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->addColumn('link', function ($row) {
                $foto = $row->foto;
                $fotoktp = $row->foto_ktp;
                return '<a class="btn editoffer"
                   data-ids = "' . $row->id . '"
                   data-alamat_house_id = "' . $row->alamat_house_id . '"
                   data-foto = "' . $foto . '"
                   data-fotoktp = "' . $fotoktp . '" >
                   <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })->addColumn('alamat', function ($row) {
                $province =  $row->province != null ? 'Prov. ' . $row->province->name : '';
                $city =  $row->city != null ? ' ' . $row->city->name : '';
                $district = $row->district != null ? ' Kec. ' . $row->district->name : '';
                return $district . $city . ' ' . $province;
            })->addColumn('job', function ($row) {
                return $row->job_id != null ? $row->job->name : '';
            })->addColumn('joblevel', function ($row) {
                return $row->job_level_id != null ? $row->jobLevel->name : '';
            })->addColumn('departement', function ($row) {
                return $row->departement_id != null ? $row->departement->name : '';
            })->rawColumns(['check', 'link', 'job', 'joblevel', 'alamat', 'departement'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getOptionEmployee()
    {
        $employee = Employee::where('parent_id', 0)->orderBy('id')->get();
        if (!empty($employee)) {
            $html = $this->toOption($employee, 0);
            return  $html;
        } else {
            return '';
        }
    }

    public function getOptionEmployee2()
    {
        if (request()->q) {
            $employee = Employee::where(DB::raw('lower(name)'), 'LIKE', '%' . request()->q . '%')->orderBy('id')->get();
        } else {
            $employee = Employee::where('parent_id', 0)->orderBy('id')->get();
        }

        if (!empty($employee)) {
            $html = $this->toOption2($employee, 0);
            return  json_encode($html);
        } else {
            return '';
        }
    }

    public function toUL(array $array, $level = 1)
    {
        $html = '';
        if (count($array)) {
            foreach ($array as $value) {
                $html .= sprintf('<a  class="dropdown-item" data-value="%s" data-level="%s" href="#">%s </a>', $value->id, $level, $value->name);
                if (!empty($value->children)) {
                    $html .= $this->toUL($value->children->sortBy('id')->values()->all(), $level + 1);
                }
            }
        }
        return $html;
    }

    public function toOption($array, $level = 0)
    {
        $html = '';
        if (count($array)) {
            foreach ($array as $value) {
                $html .= sprintf('<option value="%s" >%s</option>', $value->id, ($level > 0) ? str_repeat('&#160;&#160;&#160;', $level) . $value->name : $value->name);
                if (!empty($value->children)) {
                    $html .= $this->toOption($value->children->sortBy('id')->values()->all(), $level + 1);
                }
            }
        }
        return $html;
    }

    public function toOption2($array, $level = 0)
    {
        $response = array();
        if (count($array)) {
            foreach ($array as $value) {
                $response[] = [
                    "id" =>  $value->id,
                    "text" => ($level > 0) ? str_repeat('--', $level) . $value->name : $value->name
                ];

                if (!empty($value->children)) {
                    $response2 = $this->toOption2($value->children->sortBy('id')->values()->all(), $level + 1);
                    $response = array_merge($response, $response2);
                }
            }
        }
        return $response;
    }

    public function getEmployeeById($id, $withchild = false)
    {
        try {

            $employee = Employee::with('addressHome')->find($id);

            unset($employee['created_at']);
            unset($employee['updated_at']);
            unset($employee['deleted_at']);
            unset($employee->addressHome['created_at']);
            unset($employee->addressHome['updated_at']);
            unset($employee->addressHome['deleted_at']);

            $employee->birthday = Helpers::dateDmy($employee->birthday);
            $employee->join_date =  Helpers::dateDmy($employee->join_date);
            $employee->foto = asset('storage/' . $employee->foto);
            $employee->foto_ktp = asset('storage/' . $employee->foto_ktp);
            $employee->salary_role = number_format($employee->salary_role, 0, ',', '.');


            // Check the Employee
            if (!$employee) return $this->error("No Employee with ID $id", 404);

            return $this->success("Employee Detail", $employee);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }

    public function requestEmployee(EmployeeRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            //save dulu AddressHome

            $address = ($request->address_home_id > 0) ? AddressHome::find($request->address_home_id) :  new AddressHome;
            $address->address = $request->address;
            $address->postalcode = $request->postalcode;
            $address->province_id = $request->province_id;
            $address->city_id = $request->city_id;
            $address->district_id = $request->district_id;
            $address->village_id = $request->village_id;
            $address->rt = $request->rt;
            $address->rw = $request->rw;
            $address->save();

            $employee = request()->id ? Employee::find(request()->id) : new Employee;
            // Check the Employee
            if (request()->id && !$employee) return $this->error("No Employee with ID " . request()->id, 404);

            $data = $request->dataEmployee();

            if (@$request->file('foto')) {
                $foto = Helpers::uploadImage($request, 'foto/', 'foto', $request->name);
                $data['foto'] = $foto;
            }

            if (@$request->file('foto_ktp')) {
                $fotoktp = Helpers::uploadImage($request, 'fotoktp/', 'foto_ktp', $request->name);
                $data['foto_ktp'] = $fotoktp;
            }
            $data['address_home_id'] = ($request->address_home_id > 0) ? $request->address_home_id : $address->id;
            //dd($data);
            $dataStore =  (request()->id > 0) ? $employee->update($data) : Employee::create($data);

            // Save the Employee
            if ($dataStore) {
                DB::commit();
                return $this->success(
                    request()->id ? "Employee berhasil diupdated"
                        : "Employee berhasil disimpan",
                    [],
                    request()->id ? 200 : 201
                );
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteEmployee(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
            Employee::whereIn('id', explode(",", $ids))->delete();

            DB::commit();
            return $this->success("Employee deleted", []);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 200);
        }
    }

    public function employeeJob()
    {
        $job = Job::get();
        $job->transform(function ($jabatan) {
            return [
                'id' => $jabatan->id,
                'text' => $jabatan->name
            ];
        });
        return response()->json($job);
    }
}
