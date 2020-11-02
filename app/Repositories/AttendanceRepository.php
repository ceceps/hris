<?php

namespace App\Repositories;

use App\Helpers\Helpers;
use App\Http\Requests\AttendanceRequest;
use App\Interfaces\AttendanceInterface;
use App\Models\Attendance;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Http\Request;

class AttendanceRepository implements AttendanceInterface
{
    use ResponseAPI;

    public function getAllAttendances()
    {
        $attendaces = Attendance::get();
        return $this->success('All Attendance', $attendaces);
    }

    public function attendanceJson()
    {
        $attendaces = Attendance::orderBy('date','desc')->get();
        return DataTables::of($attendaces)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->editColumn('date', function ($row) {
                return Helpers::dateDmy($row->date);
            })
            ->addColumn('link', function ($row) {
                if ($row->sumber == 'manual') {
                    return '<a class="btn editoffer"
                data-ids = "' . $row->id . '"
                 >
                <i class="feather icon-edit f-20 text-c-black"></i></a>';
                } else {
                    return '';
                }
            })->rawColumns(['check', 'link'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getAttendanceById($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $attendance = [
                'person_id' => $attendance->attendace_id,
                'name' => $attendance->name,
                'departement' => $attendance->departement,
                'date' => Helpers::dateDmy($attendance->date),
                'checkin' => $attendance->checkin,
                'checkout' => $attendance->checkout,
                'leave_type' => $attendance->leave_type,
            ];
            return $this->success('Detil Attendance', $attendance);
        } else {
            return $this->error('Detil Attendance is Missing');
        }
    }

    public function requestAttendance(AttendanceRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $attendance = $id ? Attendance::find($id) : new Attendance;

            // Check the Employee
            if ($id && !$attendance) return $this->error("No attendance with ID " . $id, 404);
            $attendance->name = $request->name;
            $attendance->person_id = $request->person_id;
            $attendance->departement = $request->departement;
            $attendance->date = Carbon::parse($request->date);
            $attendance->leave_type = $request->leave_type;
            $attendance->checkin = $request->checkin;
            $attendance->checkout = $request->checkout;
            $attendance->update_by = auth()->user()->id;
            $attendance->sumber =  'manual';
            $attendance->save();

            DB::commit();

            return $this->success(
                request()->id ? "Attendance berhasil diupdate"
                    : "Attendance berhasil disimpan",
                $attendance,
                request()->id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteAttendance(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
            Attendance::whereIn('id', explode(",", $ids))->delete();

            DB::commit();
            return $this->success("Attendance deleted", []);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 200);
        }
    }
}
