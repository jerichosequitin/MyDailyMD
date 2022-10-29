<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImmunizationController extends Controller
{
    public function index()
    {
        $immunization = Immunization::where('user_id','=',Auth::user()->id)->get();
        return view('patientimmunization.index', compact ('immunization'));
    }

    public function create()
    {
        return view('patientimmunization.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'vaccines'=>'required',
            'purpose'=>'required',
            'dateTaken'=>'required|before:today',
        ]);

        $immunization = Immunization::create($storeData);
        return redirect('/patientimmunization')->with('Completed', 'Immunization successfully added');
    }

    public function edit($id)
    {
        $immunization= Immunization::findOrFail($id);

        $this->authorize('update', $immunization);
        return view('patientimmunization.edit', compact('immunization'));
    }

    public function update(Request $request, $id)
    {
        $updateData = request()->validate([
            'vaccines'=>'required',
            'purpose'=>'required',
            'dateTaken'=>'required|before:today',
        ]);

        Immunization::whereId($id)->update($updateData);
        return redirect("/patientimmunization")->with('Completed', 'Immunization successfully updated');
    }

    public function destroy($id)
    {
        $immunization = Immunization::findOrFail($id);
        $immunization->delete();
        return redirect("/patientimmunization")->with('Completed', 'Immunization successfully deleted');
    }
}
