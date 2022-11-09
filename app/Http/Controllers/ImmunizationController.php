<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImmunizationController extends Controller
{
    public function index()
    {
        $immunization = Immunization::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
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
            'status' => 'required',
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
        request()->validate([
            'vaccines'=>'required',
            'purpose'=>'required',
            'dateTaken'=>'required|before:today',
        ]);

        $immunization = Immunization::findOrFail($id);
        $immunization->vaccines = $request->vaccines;
        $immunization->purpose = $request->purpose;
        $immunization->dateTaken = $request->dateTaken;
        $immunization->save();
        return redirect("/patientimmunization")->with('Completed', 'Immunization successfully updated');
    }

    public function view($id)
    {
        $immunization= Immunization::findOrFail($id);

        $this->authorize('update', $immunization);
        return view('patientimmunization.view', compact('immunization'));
    }

    public function archive(Request $request, $id)
    {
        $archiveData = $request->validate([
            'status' => 'required',
        ]);

        Immunization::whereId($id)->update($archiveData);
        return redirect("/patientimmunization")->with('Completed', 'Immunization successfully deleted');
    }
}
