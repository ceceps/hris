<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressHome extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'address',
        'rt',
        'rw',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'postalcode',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
