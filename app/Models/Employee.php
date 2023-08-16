<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'fullname',
        'company',
        'position',
        'phone',
        'bankaccount',
        'npwp',
        'bpjskesehatan',
        'bpjsketenagakerjaan',  
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}

