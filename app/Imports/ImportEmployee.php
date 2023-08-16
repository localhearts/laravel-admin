<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportEmployee implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'id' => $row[0],
            'fullname' => $row[1],
            'company' => $row[2],
            'position' => $row[3],
            'phone' => $row[4],
            'bankaccount' => $row[5],
            'npwp'=> $row[6],
            'bpjskesehatan'=> $row[7],
            'bpjsketenagakerjaan'=> $row[8],
        ]);
    }
}
