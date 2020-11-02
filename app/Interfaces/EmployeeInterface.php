<?php

namespace App\Interfaces;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

interface EmployeeInterface
{
    public function getAllEmployees();
    public function EmployeeJson();
    public function getEmployeeById($id);
    public function requestEmployee(EmployeeRequest $request, $id = null);
    public function deleteEmployee(Request $request);

    public function employeeJob();
}
