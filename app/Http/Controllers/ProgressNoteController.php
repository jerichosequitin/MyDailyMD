<?php

namespace App\Http\Controllers;

use App\Models\ProgressNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressNoteController extends Controller
{
    public function index()
    {
        $progressNote = ProgressNote::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
        return view('patientprogressnote.index', compact ('progressNote'));
    }
}
