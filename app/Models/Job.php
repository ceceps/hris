<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
