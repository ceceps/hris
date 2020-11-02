<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WorkPlan extends Model
{

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'update_by');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id');
    }
}
