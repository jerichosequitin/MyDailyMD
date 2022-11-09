<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllergyController extends Controller
{
    public function index()
    {
        $allergy = Allergy::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
        return view('patientallergy.index', compact ('allergy'));
    }
}
