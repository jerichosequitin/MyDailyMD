<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitCreateProfileOnce
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
            if ($request->user()->doctor_profile->birthdate != '')
            {
                return redirect()->route('doctorprofile.show', Auth::user()->id);
            }
        }
        elseif($request->user()->type == 'patient')
        {
            if ($request->user()->patient_profile->birthdate != '')
            {
                return redirect()->route('patientprofile.show', Auth::user()->id);
            }
        }
        return $next($request);
    }
}
