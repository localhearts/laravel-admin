<?php

namespace App\Imports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportAttendance implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        return new Attendance([
            //
            'employee_id' => $row[0],
            'check_in' => Carbon::createFromFormat('d/m/Y H:i',$row[1])->format('Y-m-d H:i'),
            'check_out' => Carbon::createFromFormat('d/m/Y H:i',$row[2])->format('Y-m-d H:i'),
        ]);
       //
       

    }
}
