<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'patient_id',
        'patient_passport',
        'patient_name',
        'patient_dob',
        'medical_centre_id',
    ];

}
