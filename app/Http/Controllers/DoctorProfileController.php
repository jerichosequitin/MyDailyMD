<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorProfileController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('view', $user->doctor_profile);
        return view('doctorprofile', compact('user'));
    }

    public function create(User $user)
    {
        $this->authorize('update', $user->doctor_profile);
        return view('createdoctorprofile', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->doctor_profile);
        return view('editdoctorprofile', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->doctor_profile);

        $data = request()->validate([
            'name'=>'',
            'email'=>'',
            'birthdate'=>'',
            'sex'=>'',
            'contactNumber'=>'',
            'specialization'=>'',
            'workingHours'=>'',
            'digitalSignature'=>'',
            'prcNumber'=>'',
            'licenseType'=>'',
            'licenseExpiryDate'=>'',
            'prcImage' =>'',
            'clinicName'=>'',
            'clinicAddress'=>'',
            'clinicMobileNumber'=>'',
            'clinicTelephoneNumber'=>'',
        ]);

        $user->doctor_profile()->update($data);

        return redirect("/doctorprofile/{$user->id}");
    }
}
