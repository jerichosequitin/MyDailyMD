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

        if($user->doctor_profile->digitalSignature == '' || $user->doctor_profile->prcImage == '')
        {
            request()->validate([
                'birthdate'=>'required|date|before:-18 years',
                'sex'=>'required',
                'contactNumber'=>'required',
                'specialization'=>'required',
                'workingHours'=>'required',
                'digitalSignature'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'prcNumber'=>'required|min:7|max:7',
                'licenseType'=>'required',
                'licenseExpiryDate'=>'required|after:today',
                'prcImage' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'clinicName'=>'required',
                'clinicAddress'=>'required',
                'clinicMobileNumber'=>'nullable|min:11|max:11',
                'clinicTelephoneNumber'=>'nullable|min:9|max:9',
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
            $user->doctor_profile->workingHours = request()->workingHours;
            $user->doctor_profile->digitalSignature = $digitalSignature_path;
            $user->doctor_profile->prcNumber = request()->prcNumber;
            $user->doctor_profile->licenseType = request()->licenseType;
            $user->doctor_profile->licenseExpiryDate = request()->licenseExpiryDate;
            $user->doctor_profile->prcImage = $prcImage_path;
            $user->doctor_profile->clinicName = request()->clinicName;
            $user->doctor_profile->clinicAddress = request()->clinicAddress;
            $user->doctor_profile->clinicMobileNumber = request()->clinicMobileNumber;
            $user->doctor_profile->clinicTelephoneNumber = request()->clinicTelephoneNumber;

            $user->doctor_profile->save();
        }
        else
        {
            $data = request()->validate([
                'birthdate'=>'',
                'sex'=>'',
                'contactNumber'=>'min:11|max:11',
                'specialization'=>'',
                'workingHours'=>'',
                'digitalSignature'=>'',
                'prcNumber'=>'',
                'licenseType'=>'',
                'licenseExpiryDate'=>'',
                'prcImage' =>'',
                'clinicName'=>'',
                'clinicAddress'=>'',
                'clinicMobileNumber'=>'nullable|min:11|max:11',
                'clinicTelephoneNumber'=>'nullable|min:9|max:9',
            ]);
            $user->doctor_profile()->update($data);
        }

        return redirect("/doctorprofile/{$user->id}");
    }
}
