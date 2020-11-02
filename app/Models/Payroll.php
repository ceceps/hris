<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;

    protected $date = ['delete_at'];
    protected $fillable = [
        'job_id',
        'employee_id',
        'periode_from',
        'periode_to',
        'tgl_cetak',
        'uang_pokok',
        'uang_lembur',
        'uang_makan',
        'tunj_keluarga',
        'tunj_haritua',
        'tunj_kesehatan',
        'tunj_keselamatan',
        'tunj_kecelakaan',
        'tunj_hari_raya',
        'bonus',
        'potongan_listrik',
        'potongan_belanja',
        'potongan_koperasi',
        'potongan_lain',
        'gaji_kotor',
        'total_upah',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
