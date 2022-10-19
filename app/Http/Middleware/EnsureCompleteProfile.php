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
            if ($request->user()->doctor_profile->birthdate == '')
            {
                //dd($request->user()->doctor_profile);
                //return redirect ('dashboard');
                //return redirect('/doctorprofile/' . $request->user()->doctor_profile->id . '/create');
                return redirect()->route('doctorprofile.create', Auth::user()->id);
            }
        }
        elseif($request->user()->type == 'patient')
        {
            if($request->user()->patient_profile->birthdate == '')
            {
                //dd($request->user()->patient_profile);
                //return redirect ('dashboard');
                //return redirect('/patientprofile/' . $request->user()->patient_profile->id . '/create');
                return redirect()->route('patientprofile.create', Auth::user()->id);
            }
        }

        return $next($request);
    }
}
