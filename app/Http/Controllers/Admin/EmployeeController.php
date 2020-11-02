<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeInterface;

class EmployeeController extends Controller
{
    protected $employeeInterface;

    public function __construct(EmployeeInterface $employeeInterface)
    {
       $this->employeeInterface = $employeeInterface;
    }

    public function index()
    {
        $judul = 'Data Employee';

        return view('employees.employee', compact('judul'));
    }

    public function store(EmployeeRequest $request)
    {
         return $this->employeeInterface->requestEmployee($request);
    }

    public function update(EmployeeRequest $request,$id)
    {
        return $this->employeeInterface->requestEmployee($request,$id);
    }

}
