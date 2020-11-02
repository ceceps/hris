<?php

namespace App\Interfaces;

use App\Http\Requests\AttendanceRequest;
use Illuminate\Http\Request;

interface AttendanceInterface
{
    public function getAllAttendances();
    public function attendanceJson();
    public function getAttendanceById($id);
    public function requestAttendance(AttendanceRequest $request, $id = null);
    public function deleteAttendance(Request $request);

}
