<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PatientsExport implements FromCollection , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $medical_id =  Auth::user()->medicals[0]->medical_centre_id;
        return Patient::where('medical_centre_id',$medical_id)->get();

    }

    public function map($row): array{
        $fields = [
           $row->patient_id,
           $row->patient_name,
           $row->patient_passport,
           $row->patient_dob,
           $row->medical_centre_id,
           $row->doctor_status,
           $row->doctor_remarks,
      ];
     return $fields;
 }
}
