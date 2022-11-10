<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UniqueContactNumber;
use Illuminate\Http\Request;

class PatientProfileController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('view', $user->patient_profile);
        return view('patientprofile', compact('user'));
    }

    public function create(User $user)
    {
        $this->authorize('update', $user->patient_profile);
        return view('createpatientprofile', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->patient_profile);
        return view('editpatientprofile', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->patient_profile);

        $data = request()->validate([
            'birthdate'=>'date|before:-18 years',
            'sex'=>'',
            'address'=>'',
            'city'=>'',
            'postalCode'=>'digits:4',
            'maritalStatus' =>'',
            'mobileNumber'=>'digits:10|starts_with:9',
            'landlineNumber'=>'nullable|digits:8',
            'emergencyContact'=>'',
            'emergencyContactNumber'=>'digits:10|starts_with:9',
        ],
        [
            'mobileNumber.starts_with' => 'Mobile Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.',
            'emergencyContactNumber.starts_with' => 'Mobile Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.'
        ]);

        $user->patient_profile->update($data);
        return redirect("/patientprofile/{$user->id}");
    }
}
