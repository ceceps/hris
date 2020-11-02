<?php

namespace App\Interfaces;

use App\Http\Requests\PayrollRequest;
use Illuminate\Http\Request;

interface PayrollInterface
{
    public function getAllPayrolls();
    public function payrollJson();
    public function getPayrollById($id);
    public function requestPayroll(PayrollRequest $request, $id = null);
    public function deletePayroll(Request $request);

}
