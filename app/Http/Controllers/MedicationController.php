<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationController extends Controller
{
    public function index()
    {
        $medication = Medication::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
        return view('patientmedication.index', compact ('medication'));
    }
}
