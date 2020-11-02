<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Gaji;
use App\Models\Employee;
use App\Models\Attendance;
// use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens,Notifiable;
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function employee()
    {
        return $this->hasMany(Employee::class, 'update_by');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'update_by');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'update_by');
    }
}
