<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminClientListController extends Controller
{
    public function index(User $user)
    {
        $patient = DB::table('users')
            ->join('patient_profiles','users.id','=','patient_profiles.user_id')
            ->where('type', '=', 'patient')
            ->get();
        return view ('adminclientlist')->with('patient', $patient);
    }
}
