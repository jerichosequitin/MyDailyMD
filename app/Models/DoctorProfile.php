<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'countryCode' => 'encrypted',
        'contactNumber' => 'encrypted',
        'digitalSignature' => 'encrypted',
        'prcNumber' => 'encrypted',
        'prcImage' => 'encrypted',
        'clinicName' => 'encrypted',
        'clinicAddress' => 'encrypted',
        'clinicMobileNumber' => 'encrypted',
        'clinicTelephoneNumber' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->belongsToMany(PatientProfile::class, 'doctor_patient',
            'doctor_user_id', 'patient_user_id')
            ->withTimestamps();
    }
}
