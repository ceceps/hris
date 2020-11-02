<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use ResponseAPI;

    protected $attendanceInterface;

    public function __construct(AttendanceInterface $attendanceInterface)
    {
        $this->attendanceInterface = $attendanceInterface;
    }

    public function json()
    {
       return $this->attendanceInterface->attendanceJson();
    }

    public function show($id)
    {
        return $this->attendanceInterface->getAttendanceById($id);
    }

    public function destroy(Request $request)
    {
       return $this->attendanceInterface->deleteAttendance($request);
    }

}
