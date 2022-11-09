<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\ImmunizationController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\ProgressNoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrescriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'save'])->name('contact.store');

Route::get("email", [PHPMailerController::class, "email"])->name("email");
Route::post("send-email", [PHPMailerController::class, "composeEmail"])->name("send-email");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prescription','App\Http\Controllers\PrescriptionController@index')->name('prescription.show');

Route::get('aboutus', function (){
    return view('aboutus');
});

Route::get('subscriptionplan', function (){
    return view('subscriptionplan');
});

Route::get('contactus', function (){
    return view('contactus');
});

Route::get('termsandconditions', function (){
    return view('termsandconditions');
});

Route::get('subscriptionbillingpatient', function (){
    return view('subscriptionbillingpatient');
});

Route::get('subscriptionbillingdoctor', function (){
    return view('subscriptionbillingdoctor');
});

Route::get('userregistration', function (){
    return view('userregistration');
});

Route::get('privacypolicy', function (){
    return view('privacypolicy');
});

Route::get('pendingapproval', function (){
    return view('pendingapproval');
});

Route::get('patientsubscriptionbillingsuccess', function (){
    return view('patientsubscriptionbillingsuccess');
});

Route::get('patientprofile', function (){
    return view('patientprofile');
});

Route::get('newpasswordpt2', function (){
    return view('newpasswordpt2');
});

Route::get('newpasswordpt1', function (){
    return view('newpasswordpt1');
});

Route::get('mainsignuppage', function (){
    return view('mainsignuppage');
});

Route::get('mainpatientdashboard', function (){
    return view('mainpatientdashboard');
});

Route::get('maindoctordashboard', function (){
    return view('maindoctordashboard');
});

Route::get('forgotpassword', function (){
    return view('forgotpassword');
});

Route::get('editpatientprofile', function (){
    return view('editpatientprofile');
});

Route::get('doctorsubscriptionbillingsuccess', function (){
    return view('doctorsubscriptionbillingsuccess');
});

Route::get('codeverification', function (){
    return view('codeverification');
});

Route::get('email', function (){
    return view('email');
});

Route::get('patientlistofdoctor', function (){
    return view('patientlistofdoctor');
});
//subscription
Route::get('payment', 'App\Http\Controllers\PaymentController@index');
Route::get('subscriptionbillingdoctor','App\Http\Controllers\PaymentController@index1');
Route::post('charge', 'App\Http\Controllers\PaymentController@charge');
Route::get('success', 'App\Http\Controllers\PaymentController@success');
Route::get('error', 'App\Http\Controllers\PaymentController@error');

//patient list of doctor
Route::get('/patientlistofdoctor','App\Http\Controllers\AppointmentController@index')->name('patientlistofdoctor');

//patient my appointment

//Route::post('/patientbookappointment/{doctorProfile}/save', 'App\Http\Controllers\AppointmentController@save')->name('patientappointment.save');
Route::get('/patientbookappointment/{doctorProfile}/book', 'App\Http\Controllers\AppointmentController@book')->name('patientappointment.book');

//Auth route for Register & Login
Route::group(['middleware' => ['auth', 'verified']], function () {

    //Complete Profile First then Verify Doctor Profile
    Route::group(['middleware' => ['profile']], function () {

        //DASHBOARD
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name
        ('dashboard');

        Route::group(['middleware' => ['patientaccess']], function () {
            //PATIENT
            Route::get('/patientprofile/{user}', 'App\Http\Controllers\PatientProfileController@index')->name('patientprofile.show');
            Route::get('/patientprofile/{user}/edit', 'App\Http\Controllers\PatientProfileController@edit')->name('patientprofile.edit');

                //Health Records
            Route::resource('patientmedicalhistory', MedicalHistoryController::class);
            Route::get('/patientmedicalhistory/{medicalHistory}/view', 'App\Http\Controllers\MedicalHistoryController@view')->name('patientmedicalhistory.view');
            Route::patch('/patientmedicalhistory/{medicalHistory}/archive', 'App\Http\Controllers\MedicalHistoryController@archive')->name('patientmedicalhistory.archive');
            Route::resource('patientmedication', MedicationController::class);
            Route::resource('patientallergy', AllergyController::class);
            Route::resource('patientprogressnote', ProgressNoteController::class);
            Route::resource('patientimmunization', ImmunizationController::class);
            Route::get('/patientimmunization/{immunization}/view', 'App\Http\Controllers\ImmunizationController@view')->name('patientimmunization.view');
            Route::patch('/patientimmunization/{immunization}/archive', 'App\Http\Controllers\ImmunizationController@archive')->name('patientimmunization.archive');


            //Appointment
            Route::get('/patientappointment/list', 'App\Http\Controllers\PatientAppointmentController@index')->name('patientappointment.show');
            Route::get('/patientappointment/pending', 'App\Http\Controllers\PatientAppointmentController@pending')->name('patientappointment.pending');
            Route::get('/patientappointment/linked', 'App\Http\Controllers\PatientAppointmentController@linked')->name('patientappointment.linked');
            Route::get('/patientappointment/linked/profile/{doctorProfile}', 'App\Http\Controllers\PatientAppointmentController@doctorProfile')->name('patientappointment.doctorprofile');
            Route::get('/patientappointment/history', 'App\Http\Controllers\PatientAppointmentController@history')->name('patientappointment.history');
            Route::get('/patientappointment/{appointment}/edit', 'App\Http\Controllers\PatientAppointmentController@edit')->name('patientappointment.edit');
            Route::get('/patientappointment', 'App\Http\Controllers\PatientAppointmentController@search')->name('patientappointment.search');
            Route::get('/patientappointment/{doctorProfile}/book', 'App\Http\Controllers\PatientAppointmentController@book')->name('patientappointment.book');
            Route::patch('/patientappointment/inactive', 'App\Http\Controllers\PatientAppointmentController@inactive')->name('patientappointment.inactive');
            Route::patch('/patientappointment/{appointment}/cancel', 'App\Http\Controllers\PatientAppointmentController@cancel')->name('patientappointment.cancel');
            Route::patch('/patientappointment/{appointment}/update', 'App\Http\Controllers\PatientAppointmentController@update')->name('patientappointment.update');
        });

        Route::group(['middleware' => ['doctoraccess']], function () {
            Route::group(['middleware' => ['doctorpendingmax']], function () {
                //DOCTOR
                Route::get('/doctorprofile/{user}', 'App\Http\Controllers\DoctorProfileController@index')->name('doctorprofile.show');
                Route::get('/doctorprofile/{user}/edit', 'App\Http\Controllers\DoctorProfileController@edit')->name('doctorprofile.edit');

                //Manage Health Records
                Route::get('/doctormanagehealthrecords', 'App\Http\Controllers\DoctorManageHealthRecordsController@index')->name('managehealthrecords.show');
                Route::get('/doctormanagehealthrecords/profile/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@profile')->name('managehealthrecords.profile');
                Route::get('/doctormanagehealthrecords/medicalhistory/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicalHistory')->name('managehealthrecords.medicalhistory');

                    //Medication
                Route::get('/doctormanagehealthrecords/medication/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@medication')->name('managehealthrecords.medication');
                Route::get('/doctormanagehealthrecords/medication/{patientProfile}/create', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationCreate')->name('managehealthrecords.medication_create');
                Route::post('/doctormanagehealthrecords/medication', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationStore')->name('managehealthrecords.medication_store');
                Route::get('/doctormanagehealthrecords/medication/{medication}/edit', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationEdit')->name('managehealthrecords.medication_edit');
                Route::get('/doctormanagehealthrecords/medication/{medication}/view', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationView')->name('managehealthrecords.medication_view');
                Route::patch('/doctormanagehealthrecords/medication/{medication}', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationUpdate')->name('managehealthrecords.medication_update');
                Route::patch('/doctormanagehealthrecords/medication/{medication}/archive', 'App\Http\Controllers\DoctorManageHealthRecordsController@medicationArchive')->name('managehealthrecords.medication_archive');

                    //Allergy
                Route::get('/doctormanagehealthrecords/allergy/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergy')->name('managehealthrecords.allergy');
                Route::get('/doctormanagehealthrecords/allergy/{patientProfile}/create', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyCreate')->name('managehealthrecords.allergy_create');
                Route::post('/doctormanagehealthrecords/allergy', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyStore')->name('managehealthrecords.allergy_store');
                Route::get('/doctormanagehealthrecords/allergy/{allergy}/edit', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyEdit')->name('managehealthrecords.allergy_edit');
                Route::get('/doctormanagehealthrecords/allergy/{allergy}/view', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyView')->name('managehealthrecords.allergy_view');
                Route::patch('/doctormanagehealthrecords/allergy/{allergy}', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyUpdate')->name('managehealthrecords.allergy_update');
                Route::patch('/doctormanagehealthrecords/allergy/{allergy}/archive', 'App\Http\Controllers\DoctorManageHealthRecordsController@allergyArchive')->name('managehealthrecords.allergy_archive');

                    //Progress Notes
                Route::get('/doctormanagehealthrecords/progressnote/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNote')->name('managehealthrecords.progressnote');
                Route::get('/doctormanagehealthrecords/progressnote/{patientProfile}/create', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteCreate')->name('managehealthrecords.progressnote_create');
                Route::post('/doctormanagehealthrecords/progressnote', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteStore')->name('managehealthrecords.progressnote_store');
                Route::get('/doctormanagehealthrecords/progressnote/{progressNote}/edit', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteEdit')->name('managehealthrecords.progressnote_edit');
                Route::get('/doctormanagehealthrecords/progressnote/{progressNote}/view', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteView')->name('managehealthrecords.progressnote_view');
                Route::patch('/doctormanagehealthrecords/progressnote/{progressNote}', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteUpdate')->name('managehealthrecords.progressnote_update');
                Route::patch('/doctormanagehealthrecords/progressnote/{progressNote}/archive', 'App\Http\Controllers\DoctorManageHealthRecordsController@progressNoteArchive')->name('managehealthrecords.progressnote_archive');

                Route::get('/doctormanagehealthrecords/immunization/{patientProfile}', 'App\Http\Controllers\DoctorManageHealthRecordsController@immunization')->name('managehealthrecords.immunization');
                Route::patch('/doctormanagehealthrecords/inactive', 'App\Http\Controllers\DoctorManageHealthRecordsController@inactive')->name('managehealthrecords.inactive');

                //Appointment
                Route::get('/doctorappointment/list', 'App\Http\Controllers\DoctorAppointmentController@index')->name('doctorappointment.show');
                Route::get('/doctorappointment/upcoming', 'App\Http\Controllers\DoctorAppointmentController@upcoming')->name('doctorappointment.upcoming');
                Route::get('/doctorappointment/{appointment}/edit', 'App\Http\Controllers\DoctorAppointmentController@edit')->name('doctorappointment.edit');
                Route::get('/doctorappointment/history', 'App\Http\Controllers\DoctorAppointmentController@history')->name('doctorappointment.history');
                Route::get('/doctorappointment/{appointment}/acceptedModal', 'App\Http\Controllers\DoctorAppointmentController@acceptedModal')->name('doctorappointment.acceptedModal');
            });
            Route::get('/doctorappointment/pending', 'App\Http\Controllers\DoctorAppointmentController@pending')->name('doctorappointment.pending');
            Route::patch('/doctorappointment/{appointment}/update', 'App\Http\Controllers\DoctorAppointmentController@update')->name('doctorappointment.update');
            Route::patch('/doctorappointment/{appointment}/accepted', 'App\Http\Controllers\DoctorAppointmentController@accepted')->name('doctorappointment.accepted');
            Route::patch('/doctorappointment/{appointment}/declined', 'App\Http\Controllers\DoctorAppointmentController@declined')->name('doctorappointment.declined');
            Route::patch('/doctorappointment/{appointment}/ongoing', 'App\Http\Controllers\DoctorAppointmentController@ongoing')->name('doctorappointment.ongoing');
            Route::patch('/doctorappointment/{appointment}/done', 'App\Http\Controllers\DoctorAppointmentController@done')->name('doctorappointment.done');
        });
    });

    Route::group(['middleware' => ['adminaccess']], function () {
        //ADMIN
        Route::get('/admindoctorlist', 'App\Http\Controllers\AdminDoctorListController@index')->name('doctorlist.show');
        Route::get('/adminpatientlist', 'App\Http\Controllers\AdminPatientListController@index')->name('patientlist.show');
        Route::get('/admindoctorlist/{doctorProfile}/verify', 'App\Http\Controllers\AdminDoctorListController@verify')->name('doctorlist.verify');
        Route::patch('/admindoctorlist/{doctorProfile}', 'App\Http\Controllers\AdminDoctorListController@update')->name('doctorlist.update');
    });

    //Create Profile can only be visited once
    Route::group(['middleware' => ['createprofileonce']], function () {
        Route::get('/patientprofile/{user}/create', 'App\Http\Controllers\PatientProfileController@create')->name('patientprofile.create');
        Route::get('/doctorprofile/{user}/create', 'App\Http\Controllers\DoctorProfileController@create')->name('doctorprofile.create');
    });

    //Book Appointment
    Route::post('/patientappointment', 'App\Http\Controllers\PatientAppointmentController@store')->name('patientappointment.store');

    //Verify License
    Route::get('/doctorverifyinglicense', 'App\Http\Controllers\VerifyingLicense@index')->name('doctorverifyinglicense');

    //Update Profile
    Route::patch('/patientprofile/{user}', 'App\Http\Controllers\PatientProfileController@update')->name('patientprofile.update');
    Route::patch('/doctorprofile/{user}', 'App\Http\Controllers\DoctorProfileController@update')->name('doctorprofile.update');
});




require __DIR__.'/auth.php';

