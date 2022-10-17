<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'name'=>'',
            'email'=>'',
            'birthdate'=>'',
            'sex'=>'',
            'address'=>'',
            'city'=>'',
            'postalCode'=>'',
            'maritalStatus' =>'',
            'mobileNumber'=>'',
            'landlineNumber'=>'',
            'emergencyContact'=>'',
            'emergencyContactNumber'=>'',
        ]);

        $user->patient_profile->update($data);
        return redirect("/patientprofile/{$user->id}");
    }
}
