<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Storage;

class Employee extends Model
{
    use SoftDeletes;
    protected $date = ['deleted_at', 'join_date', 'resign_date'];
    protected $fillable = [
        'nik',
        'noktp',
        'name',
        'birthday',
        'place_birth',
        'tempat_lahir',
        'join_date',
        'resign_date',
        'departement_id',
        'job_id',
        'job_level_id',
        'ptkp_id',
        'jurnal_id',
        'bank_account',
        'bank_id',
        'bpjs_tenagakerja',
        'bpjs_kesehatan',
        'grade',
        'salary_role',
        'category_id',
        'attendance_id',
        'status',
        'religion',
        'gender',
        'marital',
        'education',
        'address_home_id',
        'mobile_phone',
        'work_phone',
        'email',
        'foto',
        'foto_ktp',
        'foto_npwp',
        'is_wafat',
        'update_by'
    ];

    public function getFotoAttribute($foto)
    {
        return Storage::disk('public')->url($foto ?? '../assets/images/noimage.jpg');
    }

    public function getFotoKtpAttribute($foto_ktp)
    {
        return Storage::disk('public')->url($foto_ktp ?? '../assets/images/noimage.jpg');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobLevel()
    {
        return $this->belongsTo(JobLevel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function addressHome()
    {
        return $this->belongsTo(AddressHome::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workplan()
    {
        return $this->hasMany(WorkPlan::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}
