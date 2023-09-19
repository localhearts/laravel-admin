<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'task',
        'employee_id',
        'status',
        'start_date',
        'end_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function report()
    {
        return $this->hasMany(Report::class);
    }
}
