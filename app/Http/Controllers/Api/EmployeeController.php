<?php

namespace App\Http\Controllers\Api;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->q != null){
            return $this->employeeInterface->getAllEmployees(request()->q );
        }else{
            return $this->employeeInterface->getAllEmployees();
        }

    }

    public function json()
    {
       return $this->employeeInterface->EmployeeJson();
    }

    public function job()
    {
        return $this->employeeInterface->employeeJob();
    }

    public function store(EmployeeRequest $request)
    {
         return $this->employeeInterface->requestEmployee($request);
    }

    public function update(EmployeeRequest $request,$id)
    {
        return $this->employeeInterface->requestEmployee($request,$id);
    }

    public function show($id)
    {
        return $this->employeeInterface->getEmployeeById($id);
    }

    public function destroy($id)
    {
        return $this->employeeInterface->deleteEmployee($id);
    }
}
