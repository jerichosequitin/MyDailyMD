<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;

class DoctorPendingMax
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
        $doctorPending = Appointment::where('doctor_id', $request->user()->doctor_profile->id)
            ->where('status', '=', 'Pending')->get();

        $doctorPendingCount = count($doctorPending);

        if($doctorPendingCount >= 5)
        {
            return redirect()->route('doctorappointment.pending')->with('Error', 'You have reached the max number of pending appointment requests. Please manage the requests to be available for appointments again.');
        }

        return $next($request);
    }
}
