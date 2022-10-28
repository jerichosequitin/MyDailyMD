<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyingLicense extends Controller
{
    public function index()
    {
        return view('doctorverifyinglicense');
    }
}
