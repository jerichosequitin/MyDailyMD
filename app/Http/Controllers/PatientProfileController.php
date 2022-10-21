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
            'birthdate'=>'date|before:-18 years',
            'sex'=>'',
            'address'=>'',
            'city'=>'',
            'postalCode'=>'nullable|min:4|max:4',
            'maritalStatus' =>'',
            'mobileNumber'=>'min:11|max:11',
            'landlineNumber'=>'nullable|min:9|max:9',
            'emergencyContact'=>'',
            'emergencyContactNumber'=>'min:11|max:11',
        ]);

        $user->patient_profile->update($data);
        return redirect("/patientprofile/{$user->id}");
    }
}
