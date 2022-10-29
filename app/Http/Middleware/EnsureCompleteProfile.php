<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->type == 'doctor')
        {
            if ($request->user()->doctor_profile->birthdate == '' || $request->user()->doctor_profile->sex == ''||
                $request->user()->doctor_profile->contactNumber == '' || $request->user()->doctor_profile->specialization == '' ||
                $request->user()->doctor_profile->workingHours == '' || $request->user()->doctor_profile->digitalSignature == '' ||
                $request->user()->doctor_profile->prcNumber == '' || $request->user()->doctor_profile->licenseType == '' ||
                $request->user()->doctor_profile->licenseExpiryDate == '' || $request->user()->doctor_profile->prcImage == '' ||
                $request->user()->doctor_profile->clinicName == '' || $request->user()->doctor_profile->clinicAddress == '')
            {
                //dd($request->user()->doctor_profile);
                //return redirect ('dashboard');
                //return redirect('/doctorprofile/' . $request->user()->doctor_profile->id . '/create');
                return redirect()->route('doctorprofile.create', Auth::user()->id)->with('Error', 'Please complete your profile first.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == '')
            {
                return redirect()->route('doctorverifyinglicense')->with('Error', 'Please wait for an admin to verify your profile.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == 'Disabled')
            {
                return redirect()->route('doctorprofile.create', Auth::user()->id)->with('Error', 'Profile Verification failed. Please double check entered information then resubmit.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == 'Change')
            {
                return redirect()->route('doctorprofile.create', Auth::user()->id)->with('Success', 'Change request approved. Please double check entered information then resubmit.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == '')
            {
                return redirect()->route('doctorverifyinglicense')->with('Error', 'Please wait for an admin to verify your profile.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == 'Disabled')
            {
                return redirect()->route('doctorprofile.create', Auth::user()->id)->with('Error', 'Profile Verification failed. Please double check entered information then resubmit.');
            }
            elseif(Auth::user()->doctor_profile->isVerified == 'Change')
            {
                return redirect()->route('doctorprofile.create', Auth::user()->id)->with('Success', 'Change request approved. Please double check entered information then resubmit.');
            }
        }
        elseif($request->user()->type == 'patient')
        {
            if($request->user()->patient_profile->birthdate == '' || $request->user()->patient_profile->sex == '' ||
                $request->user()->patient_profile->address == '' || $request->user()->patient_profile->city == '' ||
                $request->user()->patient_profile->maritalStatus == '' || $request->user()->patient_profile->mobileNumber == '' ||
                $request->user()->patient_profile->emergencyContact == '' || $request->user()->patient_profile->emergencyContactNumber == '')
            {
                //dd($request->user()->patient_profile);
                //return redirect ('dashboard');
                //return redirect('/patientprofile/' . $request->user()->patient_profile->id . '/create');
                return redirect()->route('patientprofile.create', Auth::user()->id)->with('Error', 'Please complete your profile first.');
            }
        }

        return $next($request);
    }
}
