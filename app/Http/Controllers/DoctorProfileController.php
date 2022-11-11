<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
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

        if($user->doctor_profile->isVerified != 'Enabled')
        {
            request()->validate([
                'birthdate'=>'required|before:-18 years',
                'sex'=>'required',
                'contactNumber'=>'required|unique:doctor_profiles|digits:10|starts_with:9',
                'specialization'=>'required',
                'workingHoursStart'=>'required|',
                'workingHoursEnd'=>'required|after:workingHoursStart',
                'digitalSignature'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
                'prcNumber'=>'required|unique:doctor_profiles|digits:7',
                'licenseType'=>'required',
                'licenseExpiryDate'=>'required|after:today',
                'prcImage' =>'required|image|mimes:jpeg,png,jpg,gif,svg',
                'clinicName'=>'required',
                'clinicAddress'=>'required',
                'clinicMobileNumber'=>'required|unique:doctor_profiles|digits:10|starts_with:9',
                'clinicTelephoneNumber'=>'nullable|unique:doctor_profiles|digits:8',
            ],
                [
                    'workingHoursEnd.after' => 'Working Hours End should be after Working Hours Start',
                    'contactNumber.starts_with' => 'Contact Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.',
                    'clinicMobileNumber.starts_with' => 'Clinic Mobile Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.'
                ]);

            $digitalSignature_name = time().'.'.request()->digitalSignature->extension();
            request()->digitalSignature->move(public_path('digital_signature_image'), $digitalSignature_name);
            $digitalSignature_path = "/digital_signature_image/".$digitalSignature_name;

            $prcImage_name = time().'.'. request()->prcImage->extension();
            request()->prcImage->move(public_path('prc_image'), $prcImage_name);
            $prcImage_path = "/prc_image/".$prcImage_name;

            $user->doctor_profile->birthdate = request()->birthdate;
            $user->doctor_profile->sex = request()->sex;
            $user->doctor_profile->contactNumber = request()->contactNumber;
            $user->doctor_profile->specialization = request()->specialization;
            $user->doctor_profile->workingHoursStart = request()->workingHoursStart;
            $user->doctor_profile->workingHoursEnd = request()->workingHoursEnd;
            $user->doctor_profile->digitalSignature = $digitalSignature_path;
            $user->doctor_profile->prcNumber = request()->prcNumber;
            $user->doctor_profile->licenseType = request()->licenseType;
            $user->doctor_profile->licenseExpiryDate = request()->licenseExpiryDate;
            $user->doctor_profile->prcImage = $prcImage_path;
            $user->doctor_profile->clinicName = request()->clinicName;
            $user->doctor_profile->clinicAddress = request()->clinicAddress;
            $user->doctor_profile->clinicMobileNumber = request()->clinicMobileNumber;
            $user->doctor_profile->clinicTelephoneNumber = request()->clinicTelephoneNumber;

            $user->doctor_profile->isVerified = '';

            $user->doctor_profile->save();
        }
        else
        {
            $data = request()->validate([
                'birthdate'=>'',
                'sex'=>'',
                'contactNumber'=>'unique:doctor_profiles|required|digits:10|starts_with:9',
                'specialization'=>'',
                'workingHoursStart'=>'required',
                'workingHoursEnd'=>'required|after:workingHoursStart',
                'digitalSignature'=>'',
                'prcNumber'=>'',
                'licenseType'=>'',
                'licenseExpiryDate'=>'',
                'prcImage' =>'',
                'clinicName'=>'',
                'clinicAddress'=>'',
                'clinicMobileNumber'=>'required|unique:doctor_profiles|digits:10|starts_with:9',
                'clinicTelephoneNumber'=>'nullable|unique:doctor_profiles|digits:8',
            ],
                [
                    'workingHoursEnd.after' => 'Working Hours End should be after Working Hours Start',
                    'contactNumber.starts_with' => 'Contact Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.',
                    'clinicMobileNumber.starts_with' => 'Contact Number must be the last 10 digits when following the format (+63) 9XXXXXXXXX.'
                ]);

            $user->doctor_profile->contactNumber = request()->contactNumber;
            $user->doctor_profile->workingHoursStart = request()->workingHoursStart;
            $user->doctor_profile->workingHoursEnd = request()->workingHoursEnd;
            $user->doctor_profile->clinicMobileNumber = request()->clinicMobileNumber;
            $user->doctor_profile->clinicTelephoneNumber = request()->clinicTelephoneNumber;
            //$user->doctor_profile()->update($data);
            $user->doctor_profile->save();
        }

        return redirect("/doctorprofile/{$user->id}");
    }
}
