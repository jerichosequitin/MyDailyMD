<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Create Immunization',
                'created_at' => Carbon::now()
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

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Update Immunization ID: '.$id,
                'created_at' => Carbon::now()
            ]);

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

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Archive Immunization ID: '.$id,
                'created_at' => Carbon::now()
            ]);

        Immunization::whereId($id)->update($archiveData);
        return redirect("/patientimmunization")->with('Completed', 'Immunization successfully deleted');
    }
}
