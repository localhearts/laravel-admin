<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAttendance implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            //
            'employee_id' => $row[0],
            'check_in' => $row[1],
            'check_out' => $row[2],
        ]);
    }
}
