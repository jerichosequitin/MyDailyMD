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
        return view ('prescription');
    }

}
