<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $guarded = [];

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
