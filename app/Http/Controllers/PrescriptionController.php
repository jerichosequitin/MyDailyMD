<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function index(User $user)
    {
        $doc = DB::table('users')
            ->join('doctor_profiles','users.id','=','doctor_profiles.user_id')
            ->where('type', '=', 'doctor')
            ->where('isVerified', '=', 'Enabled')
            ->get();
        return view ('prescription')->with('doc', $doc);
    }

}
