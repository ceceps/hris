<?php

namespace App\Models;

use App\Traits\Utilities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use Utilities;

    public $timestamps = false;
    public $date = ['deleted_at'];
    protected $fillable = ['kode_unit','name','parent_id','tgl_dibentuk'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }


}
