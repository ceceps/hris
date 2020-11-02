<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollRequest;
use App\Interfaces\PayrollInterface;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    private $payrolInterface;

    public function __construct(PayrollInterface $payrollInterface)
    {
        $this->payrolInterface = $payrollInterface;
    }

    public function index()
    {
        $judul = 'Data Payroll';
        return view('payrolls.payroll',['judul'=>$judul]);
    }

    public function json()
    {
        return $this->payrolInterface->payrollJson();
    }

    public function store(PayrollRequest $request)
    {
        return $this->payrolInterface->requestPayroll($request);
    }
}
