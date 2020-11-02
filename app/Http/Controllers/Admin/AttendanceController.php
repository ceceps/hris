<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Imports\AttendanceImport;
use App\Interfaces\AttendanceInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    use ResponseAPI;

    protected $attendanceInterface;

    public function __construct(AttendanceInterface $attendanceInterface)
    {
        $this->attendanceInterface = $attendanceInterface;
    }

    public function index()
    {
        $judul = 'Data Attendace';
        return view('attendance.attendance', compact('judul'));
    }

    public function fileImport(Request $request)
    {
        $import = Excel::import(new AttendanceImport, $request->file('file')->store('temp'));
        if ($import) {
            return $this->success('Berhasil Import', []);
        } else {
            return $this->error('Gagal Import', []);
        }
    }

    public function store(AttendanceRequest $request)
    {
        return $this->attendanceInterface->requestAttendance($request);
    }
    
    public function update(AttendanceRequest $request,$id)
    {
        return $this->attendanceInterface->requestAttendance($request,$id);
    }

    public function show($id)
    {
        return $this->attendanceInterface->getAttendanceById($id);
    }
}
