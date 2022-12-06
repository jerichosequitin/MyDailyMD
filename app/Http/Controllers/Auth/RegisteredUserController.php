<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'lastName' => ['required', 'regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->firstName.' '.$request->lastName,
            'email' => $request->email,
            'type' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole($request->role_id);
        event (new Registered($user));

        event(new Registered($user));

        Auth::login($user);

        //For Doctors
        if($request->role_id == 'doctor')
        {
            request()->validate([
                'prcNumber'=>'required|unique:doctor_profiles|digits:7',
                'licenseExpiryDate'=>'required|after:today',
            ]);

            $user->doctor_profile->prcNumber = $request->prcNumber;
            $user->doctor_profile->licenseExpiryDate = $request->licenseExpiryDate;

            $user->doctor_profile->save();
        }

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Register',
                'created_at' => Carbon::now()
            ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
