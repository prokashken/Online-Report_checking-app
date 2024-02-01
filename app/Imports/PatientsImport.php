<?php

namespace App\Imports;

use App\Models\Patient;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class PatientsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $bin = Patient::get();
        $bin_number = $bin->pluck('patient_id');
        if ($bin_number->contains($row[0]) == false) 
        {
            return new Patient([

                'patient_id' => $row[0],
                'patient_passport' => $row[1],
                'patient_name' => $row[2],
                'patient_dob' => $row[3],
                'medical_centre_id' => $row[4],
                // 'doctor_status' => $row[0],
                // 'doctor_remarks' => $row[0]
            ]);
        }
        else null;
    }
}
