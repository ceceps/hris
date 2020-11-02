<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLevel extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function employee()
    {
        return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
