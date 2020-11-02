<?php

namespace App\Repositories;

use App\Http\Requests\PayrollRequest;
use App\Interfaces\PayrollInterface;
use App\Models\Payroll;
use App\Traits\ResponseAPI;
use DataTables;
use Illuminate\Http\Request;
use DB;

class PayrollRepository implements PayrollInterface
{
    use ResponseAPI;

    public function getAllPayrolls()
    {
        $payroll = Payroll::orderBy('created_at', 'desc')->get();
        return $payroll;
    }
    public function payrollJson()
    {
       $payroll = Payroll::with('employee')->orderBy('created_at','desc')->get();
       return DataTables::of($payroll)
       ->addColumn('check', function ($row) {
           return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
       })
       ->addColumn('periode', function ($row) {
        return $row->periode_from.' s/d '.$row->periode_to;
    })
       ->addColumn('link', function ($row) {
           return '<a class="btn editoffer"
                data-ids = "' . $row->id . '"
                data-name = "' . $row->name . '" >
                <i class="feather icon-edit f-20 text-c-black"></i></a>';
       })
       ->rawColumns(['check', 'link','periode'])
       ->addIndexColumn()
       ->make(true);
    }

    public function getPayrollById($id)
    {
        # code...
    }

    public function requestPayroll(PayrollRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $payroll = request()->id ? Payroll::find(request()->id) : new Payroll;
            $data = $request->data();

            $dataStore = request()->id ? $payroll->update($data): $payroll->create($data);
            if($dataStore){
                DB::commit();
                return $this->success('Payroll berhasil disimpan',[]);
            }else{
                DB::rollback();
                return $this->error('Payroll Gagal disimpan',[]);
            }

        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), 422);
        }
    }

    public function deletePayroll(Request $request)
    {

    }

}
