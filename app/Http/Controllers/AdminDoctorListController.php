<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDoctorListController extends Controller
{
    public function index(User $user)
    {
        $doc = DB::table('users')
                        ->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.user_id')
                        ->where('type', '=', 'doctor')
                        ->get();
        return view ('admindoctorlist')->with('doc', $doc);
    }

    public function verify($id)
    {
        $doctorProfile = DoctorProfile::findOrFail($id);
        return view('verifydoctorlicense', compact('doctorProfile'));
    }

    public function update(Request $request, $id)
    {
        $updateData = request()->validate([
            'isVerified'=>'required',
        ]);

        DoctorProfile::whereId($id)->update($updateData);
        return redirect("/admindoctorlist")->with('Completed', 'Doctor ID:'.$id.' Account Status Updated');
    }
}
