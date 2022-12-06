<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDoctorListController extends Controller
{
    public function index(User $user)
    {
        $doc = DB::table('users')
                        ->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.user_id')
                        ->where('doctor_profiles.birthdate', '!=', '')
                        ->where('type', '=', 'doctor')
                        ->orderBy('doctor_profiles.isVerified', 'ASC')
                        ->simplePaginate(3);
        return view ('admindoctorlist')->with('doc', $doc);
    }

    public function verify($id)
    {
        $doctorProfile = DoctorProfile::findOrFail($id);
        return view('verifydoctorlicense', compact('doctorProfile'));
    }

    public function update(Request $request, $id)
    {
        if($request->isVerified == 'Disabled')
        {
            $updateData = request()->validate([
                'isVerified' => 'required',
            ]);

            request()->validate([
                'reason' => 'required',
            ],
                [
                    'reason.required' => 'Please add the reason for disabling the user.',
                ]);

            DB::table('doctor_verification_logs')
                ->insert([
                    'admin_user_id' => $request->admin_user_id,
                    'doctor_id' => $request->doctor_id,
                    'action' => 'Set to ' . $request->isVerified,
                    'reason' => $request->reason,
                    'created_at' => \Carbon\Carbon::now()
                ]);

            DoctorProfile::whereId($id)->update($updateData);
            return redirect("/admindoctorlist")->with('Completed', 'Doctor ID: ' . $id . ' Account Status updated to ' . $request->isVerified);
        }
        else
        {
            $updateData = request()->validate([
                'isVerified' => 'required',
            ]);

            DB::table('doctor_verification_logs')
                ->insert([
                    'admin_user_id' => $request->admin_user_id,
                    'doctor_id' => $request->doctor_id,
                    'action' => 'Set to ' . $request->isVerified,
                    'created_at' => \Carbon\Carbon::now()
                ]);

            DoctorProfile::whereId($id)->update($updateData);
            return redirect("/admindoctorlist")->with('Completed', 'Doctor ID: ' . $id . ' Account Status updated to ' . $request->isVerified);
        }
    }
}
