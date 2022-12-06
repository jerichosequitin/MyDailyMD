<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UniqueContactNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'countryCode'=>'',
            'mobileNumber'=>'digits:10',
            'landlineNumber'=>'nullable|digits:8',
            'emergencyContact'=>'',
            'emergencyContactNumber'=>'digits:10',
        ]);

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Update Profile',
                'created_at' => Carbon::now()
            ]);

        $user->patient_profile->update($data);
        return redirect("/patientprofile/{$user->id}");
    }
}
