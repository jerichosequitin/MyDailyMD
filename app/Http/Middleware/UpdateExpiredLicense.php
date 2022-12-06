<?php

namespace App\Http\Middleware;

use App\Models\DoctorProfile;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateExpiredLicense
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
        if ($request->user()->doctor_profile->licenseExpiryDate < Carbon::now()->toDateString())
        {
            return redirect()->route('doctor.updatelicense', Auth::user()->id)->with('Error', 'Your PRC License has expired. Please update your license credentials.');
        }

        return $next($request);
    }
}
