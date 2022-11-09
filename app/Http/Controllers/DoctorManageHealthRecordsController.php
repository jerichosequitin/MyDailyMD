<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Appointment;
use App\Models\Immunization;
use App\Models\MedicalHistory;
use App\Models\Medication;
use App\Models\PatientProfile;
use App\Models\ProgressNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorManageHealthRecordsController extends Controller
{
    public function index(User $user)
    {
        $list = DB::table('doctor_patient')
            ->join('users', 'doctor_patient.patient_user_id', '=', 'users.id')
            ->join('patient_profiles', 'doctor_patient.patient_user_id', '=', 'patient_profiles.user_id')
            ->where('doctor_patient.doctor_user_id', '=', Auth::user()->id)
            ->where('doctor_patient.linkStatus', '=', 'Active')

            ->select('*', 'patient_profiles.id as patient_id')
            ->orderBy('doctor_patient.updated_at', 'DESC')
            ->simplePaginate(4);

        return view('doctormanagehealthrecords.index', compact('user'))->with('list', $list);
    }

    public function inactive(Request $request)
    {
        $existingAppointment = Appointment::where([
            ['doctor_user_id', '=', $request->doctor_user_id],
            ['patient_user_id', '=', $request->patient_user_id],
            ['status', '!=', 'Done'],
            ['status', '!=', 'Cancelled'],
            ['status', '!=', 'Declined'],
            ['status', '!=', 'Pending']
        ])->exists();

        if($existingAppointment)
        {
            return redirect('/doctormanagehealthrecords')->with('Error', 'You have an upcoming appointment with the Patient. Cannot set Link Status to Inactive.');
        }
        else
        {
            DB::table('doctor_patient')
                ->where('doctor_user_id', Auth::user()->id)
                ->where('patient_user_id', '=', $request->patient_user_id)
                ->update([
                    'linkStatus' => 'Inactive',
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            return redirect('/doctormanagehealthrecords')->with('Completed', 'Link Status with Patient set to Inactive. You can no longer access their Health Records.');
        }

    }

    public function profile($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);
                return view('doctormanagehealthrecords.profile', compact('patientProfile'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medicalHistory($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                $medicalHistory = MedicalHistory::where('user_id','=',$patientProfile->user_id)
                    ->where('status', '=', 'Active')
                    ->simplePaginate(3);
                return view('doctormanagehealthrecords.medicalhistory', compact ('patientProfile','medicalHistory'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medication($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                $medication = Medication::where('user_id','=',$patientProfile->user_id)
                    ->where('status', '=', 'Active')
                    ->simplePaginate(3);
                return view('doctormanagehealthrecords.medication', compact ('patientProfile','medication'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medicationCreate($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                return view('doctormanagehealthrecords.medication_create', compact('patientProfile'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medicationStore(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'name'=>'required',
            'dosage'=>'required',
            'frequency' => 'required',
            'physician'=>'required',
            'startDate'=>'required',
            'endDate'=>'required|after:startDate',
            'purpose' => 'required',
            'createdBy_user_id'=>'required',
            'createdBy'=>'required',
            'status'=>'required',
        ]);

        $patientUserID = $request->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $medication = Medication::create($storeData);
        return redirect("/doctormanagehealthrecords/medication/".$patientProfile->id)->with('Completed', 'Medication successfully added');
    }

    public function medicationView($id)
    {
        $medication= Medication::findOrFail($id);
        $patientUserID = $medication->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($medication->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.medication_view', compact('medication', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medicationEdit($id)
    {
        $medication= Medication::findOrFail($id);
        $patientUserID = $medication->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($medication->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.medication_edit', compact('medication', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function medicationUpdate(Request $request, $id)
    {
        request()->validate([
            'name'=>'required',
            'dosage'=>'required',
            'frequency' => 'required',
            'physician'=>'required',
            'startDate'=>'required',
            'endDate'=>'required|after:startDate',
            'purpose' => 'required',
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
        ]);

        $medication = Medication::findOrFail($id);
        $medication->name = $request->name;
        $medication->dosage = $request->dosage;
        $medication->frequency = $request->frequency;
        $medication->physician = $request->physician;
        $medication->startDate = $request->startDate;
        $medication->endDate = $request->endDate;
        $medication->purpose = $request->purpose;
        $medication->modifiedBy_user_id = $request->modifiedBy_user_id;
        $medication->modifiedBy = $request->modifiedBy;
        $medication->save();

        $patientUserID = $medication->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();

        return redirect("/doctormanagehealthrecords/medication/".$patient->id)->with('Completed', 'Medication successfully updated');
    }

    public function medicationArchive(Request $request, $id)
    {
        $request->validate([
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
            'status' => 'required',
        ]);

        $medication = Medication::findOrFail($id);
        $medication->modifiedBy_user_id = $request->modifiedBy_user_id;
        $medication->modifiedBy = $request->modifiedBy;
        $medication->status = $request->status;
        $medication->save();

        $patientUserID = $medication->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();
        return redirect("/doctormanagehealthrecords/medication/".$patient->id)->with('Completed', 'Medication successfully deleted');
    }

    public function allergy($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                $allergy = Allergy::where('user_id','=',$patientProfile->user_id)
                    ->where('status', '=', 'Active')
                    ->simplePaginate(3);
                return view('doctormanagehealthrecords.allergy', compact ('patientProfile','allergy'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function allergyCreate($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                return view('doctormanagehealthrecords.allergy_create', compact('patientProfile'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function allergyStore(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'type'=>'required',
            'trigger'=>'required',
            'reaction' => 'required',
            'treatment'=>'required',
            'createdBy_user_id'=>'required',
            'createdBy'=>'required',
            'status'=>'required',
        ]);

        $patientUserID = $request->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $allergy = Allergy::create($storeData);
        return redirect("/doctormanagehealthrecords/allergy/".$patientProfile->id)->with('Completed', 'Allergy successfully added');
    }

    public function allergyView($id)
    {
        $allergy = Allergy::findOrFail($id);
        $patientUserID = $allergy->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($allergy->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.allergy_view', compact('allergy', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function allergyEdit($id)
    {
        $allergy= Allergy::findOrFail($id);
        $patientUserID = $allergy->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($allergy->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.allergy_edit', compact('allergy', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function allergyUpdate(Request $request, $id)
    {
        request()->validate([
            'type'=>'required',
            'trigger'=>'required',
            'reaction' => 'required',
            'treatment'=>'required',
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
        ]);

        $allergy = Allergy::findOrFail($id);
        $allergy->type = $request->type;
        $allergy->trigger = $request->trigger;
        $allergy->reaction = $request->reaction;
        $allergy->treatment = $request->treatment;
        $allergy->modifiedBy_user_id = $request->modifiedBy_user_id;
        $allergy->modifiedBy = $request->modifiedBy;
        $allergy->save();

        $patientUserID = $allergy->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();

        return redirect("/doctormanagehealthrecords/allergy/".$patient->id)->with('Completed', 'Allergy successfully updated');
    }

    public function allergyArchive(Request $request, $id)
    {
        $request->validate([
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
            'status' => 'required',
        ]);

        $allergy = Allergy::findOrFail($id);
        $allergy->modifiedBy_user_id = $request->modifiedBy_user_id;
        $allergy->modifiedBy = $request->modifiedBy;
        $allergy->status = $request->status;
        $allergy->save();

        $patientUserID = $allergy->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();
        return redirect("/doctormanagehealthrecords/allergy/".$patient->id)->with('Completed', 'Allergy successfully deleted');
    }

    public function progressNote($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                $progressNote = ProgressNote::where('user_id','=',$patientProfile->user_id)
                    ->where('status', '=', 'Active')
                    ->simplePaginate(3);
                return view('doctormanagehealthrecords.progressnote', compact ('patientProfile','progressNote'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function progressNoteCreate($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                return view('doctormanagehealthrecords.progressnote_create', compact('patientProfile'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function progressNoteStore(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'primaryDiagnosis'=>'required',
            'findings'=>'required',
            'treatmentPlan' => 'required',
            'createdBy_user_id'=>'required',
            'createdBy'=>'required',
            'status'=>'required',
        ]);

        $patientUserID = $request->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $progressNote = ProgressNote::create($storeData);
        return redirect("/doctormanagehealthrecords/progressnote/".$patientProfile->id)->with('Completed', 'Progress Note successfully added');
    }

    public function progressNoteView($id)
    {
        $progressNote = ProgressNote::findOrFail($id);
        $patientUserID = $progressNote->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($progressNote->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.progressnote_view', compact('progressNote', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function progressNoteEdit($id)
    {
        $progressNote = ProgressNote::findOrFail($id);
        $patientUserID = $progressNote->user_id;
        $patientProfile = PatientProfile::where('user_id', $patientUserID)
            ->first();

        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $patientProfile->id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                if($progressNote->status == 'Archived')
                {
                    return redirect()->back()->with('Error', 'Record is already archived.');
                }
                else
                {
                    return view('doctormanagehealthrecords.progressnote_edit', compact('progressNote', 'patientProfile'));
                }
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function progressNoteUpdate(Request $request, $id)
    {
        request()->validate([
            'primaryDiagnosis'=>'required',
            'findings'=>'required',
            'treatmentPlan' => 'required',
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
        ]);

        $progressNote = ProgressNote::findOrFail($id);
        $progressNote->primaryDiagnosis = $request->primaryDiagnosis;
        $progressNote->findings = $request->findings;
        $progressNote->treatmentPlan = $request->treatmentPlan;
        $progressNote->modifiedBy_user_id = $request->modifiedBy_user_id;
        $progressNote->modifiedBy = $request->modifiedBy;
        $progressNote->save();

        $patientUserID = $progressNote->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();

        return redirect("/doctormanagehealthrecords/progressnote/".$patient->id)->with('Completed', 'Progress Note successfully updated');
    }

    public function progressNoteArchive(Request $request, $id)
    {
        $request->validate([
            'modifiedBy_user_id'=>'required',
            'modifiedBy'=>'required',
            'status' => 'required',
        ]);

        $progressNote = ProgressNote::findOrFail($id);
        $progressNote->modifiedBy_user_id = $request->modifiedBy_user_id;
        $progressNote->modifiedBy = $request->modifiedBy;
        $progressNote->status = $request->status;
        $progressNote->save();

        $patientUserID = $progressNote->user_id;
        $patient = PatientProfile::where('user_id', $patientUserID)
            ->first();

        return redirect("/doctormanagehealthrecords/progressnote/".$patient->id)->with('Completed', 'Progress Note successfully deleted');
    }

    public function immunization($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('patient_id', '=', $id)
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $patientProfile = PatientProfile::findOrFail($id);

                $immunization = Immunization::where('user_id','=',$patientProfile->user_id)
                    ->where('status', '=', 'Active')
                    ->simplePaginate(3);
                return view('doctormanagehealthrecords.immunization', compact ('patientProfile','immunization'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }
}
