<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KartuKeluarga extends Model
{
    use SoftDeletes;
    public $tableName = 'kartu_keluargas';
    protected $date =['deleted_at'];
    protected $fillable = ['nokk','tgl_keluar','fotokk'];

    public function user()
    {
        return $this->belongsTo(User::class,'update_by');
    }
    public function keluarga()
    {
        return $this->hasOne(Keluarga::class);
    }
}
