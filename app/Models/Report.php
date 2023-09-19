<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'capture',
        'employee_id',
        'description',
        
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
