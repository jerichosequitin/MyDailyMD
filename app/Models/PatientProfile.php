<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'maritalStatus' => 'encrypted',
        'address' => 'encrypted',
        'city' => 'encrypted',
        'postalCode' => 'encrypted',
        'mobileNumber' => 'encrypted',
        'landlineNumber' => 'encrypted',
        'emergencyContact' => 'encrypted',
        'emergencyContactNumber' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(DoctorProfile::class, 'doctor_patient',
        'patient_user_id', 'doctor_user_id')
        ->withTimestamps();
    }
}
