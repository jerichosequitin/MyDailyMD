<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return view('admindashboard');
        }
        elseif(Auth::user()->hasRole('doctor')){
            return view('doctordashboard');
        }
        else{
            return view('patientdashboard');
        }
    }
}
