<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class AttendanceImport implements ToModel, WithStartRow
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(strpos($row[0], 'Check-in')!==false){
            return null;
        }

        return new Attendance([
            'person_id'=> str_replace("'","",$row[0]),
            'name'=> $row[1],
            'departement'=> $row[2],
            'date' => $row[3],
            'shift'=> $row[4],
            'timetable'=> $row[5],
            'start_work'=> $row[6],
            'end_work'=> $row[7],
            'checkin'=> ($row[8]!='-')?$row[8]:null,
            'checkout'=> ($row[9]!='-')?$row[9]:null,
            'late'=> $row[10],
            'early_leave'=> $row[11],
            'attended'=> $row[12],
            'absent'=> $row[13],
            'worked'=> $row[14],
            'break'=> $row[15],
            'leave_type'=> $row[16],
            'leave'=> $row[17],
            'OT1'=> $row[18],
            'OT2'=> $row[19],
            'OT3'=> $row[20],
            'update_by'=> auth()->user()->id,
            'sumber'=> 'upload'
        ]);

    }

    // public function rules(): array
    // {
    //     return [
    //         '0' => Rule::in(['Check-in']),
    //     ];
    // }

    public function startRow(): int
    {
        return 2;
    }
}
