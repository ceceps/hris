<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'person_id',
        'name',
        'departement',
        'date',
        'shift',
        'timetable',
        'start_work',
        'end_work',
        'checkin',
        'checkout',
        'late',
        'early_leave',
        'attended',
        'absent',
        'worked',
        'break',
        'leave_type',
        'leave',
        'OT1',
        'OT2',
        'OT3',
        'update_by',
        'sumber'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
