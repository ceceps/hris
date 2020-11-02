<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class Keluarga extends Model
{
    use SoftDeletes;
    public $date = ['deleted_at'];
    protected $fillable = [
        'kode_kel',
        'kartu_keluarga_id',
        'name',
        'noktp',
        'tempat_lahir',
        'tgl_lahir',
        'nama_kk',
        'alamat',
        'agama',
        'jk',
        'rt',
        'rw',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'kodepos',
        'update_by',
        'unit_id'
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class,'kartu_keluarga_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
    public function getFotokkAttribute()
    {
        return $this->fotokk!=null?asset($this->fotokk):asset('images/noimage.jpg');
    }
}
