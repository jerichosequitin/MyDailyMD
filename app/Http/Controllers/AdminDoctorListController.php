<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDoctorListController extends Controller
{
    public function index(User $user)
    {
        $doc = DB::table('users')
                        ->where('type', '=', 'doctor')
                        ->get();
        return view ('admindoctorlist')->with('doc', $doc);
    }
}
