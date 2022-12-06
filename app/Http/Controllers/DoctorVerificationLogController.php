<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorVerificationLogController extends Controller
{
    public function index(User $user)
    {
        $logs = DB::table('doctor_verification_logs')
            ->join('users', 'doctor_verification_logs.admin_user_id', '=', 'users.id')
            ->orderBy('doctor_verification_logs.created_at', 'DESC')
            ->select('*', 'doctor_verification_logs.created_at as created_at')
            ->simplePaginate(8);
        return view ('doctorverificationlogs')->with('logs', $logs);
    }
}
