<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnsureUserIsSubscribed
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
            $dateNow = Carbon::now();
            $dateToday = $dateNow->toDateString();

            $isSubscribed = DB::table('payments')
                ->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>', Carbon::now()->subDays(30))
                ->exists();

            if(!$isSubscribed)
            {
                return redirect()->route('doctor.subscription');
            }
        }
        elseif($request->user()->type == 'patient')
        {
            $dateNow = Carbon::now();
            $dateToday = $dateNow->toDateString();

            $isSubscribed = DB::table('payments')
                ->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>', Carbon::now()->subDays(30))
                ->exists();

            if(!$isSubscribed)
            {
                return redirect()->route('patient.subscription');
            }
        }
        return $next($request);
    }
}
