<?php

use App\Http\Controllers\PHPMailerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MedicalHistoryController;

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

Route::get('patientprogressnotes', function (){
    return view('patientprogressnotes');
});

Route::get('patientprofile', function (){
    return view('patientprofile');
});

Route::get('patientmyappointment', function (){
    return view('patientmyappointment');
});

Route::get('patientmedications', function (){
    return view('patientmedications');
});


Route::get('patientimmunization', function (){
    return view('patientimmunization');
});

Route::get('patientallergies', function (){
    return view('patientallergies');
});

Route::get('patientaddmedicalhistory', function (){
    return view('patientaddmedicalhistory');
});

Route::get('patientaddimmunization', function (){
    return view('patientaddimmunization');
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

Route::get('doctorhealthrecords', function (){
    return view('doctorhealthrecords');
});

Route::get('doctorclinicinformationyes', function (){
    return view('doctorclinicinformationyes');
});

Route::get('doctorclinicinformationno', function (){
    return view('doctorclinicinformationno');
});

Route::get('doctorclinicinformation', function (){
    return view('doctorclinicinformation');
});

Route::get('doctorappointments', function (){
    return view('doctorappointments');
});

Route::get('doctorappointmenthistory', function (){
    return view('doctorappointmenthistory');
});

Route::get('doctoraddmedications', function (){
    return view('doctoraddmedications');
});

Route::get('doctoraddallergies', function (){
    return view('doctoraddallergies');
});

Route::get('codeverification', function (){
    return view('codeverification');
});

Route::get('adminhomepage', function (){
    return view('adminhomepage');
});

Route::get('/admindoctorlist', 'App\Http\Controllers\AdminDoctorListController@index')->name('doctorlist.show');

Route::get('adminclientlist', function (){
    return view('adminclientlist');
});
Route::get('email', function (){
    return view('email');
});


//Auth route for Register & Login
Route::group(['middleware' => ['auth', 'verified']], function () {
    //Complete Profile First
    Route::group(['middleware' => ['profile']], function () {

        //DASHBOARD
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name
        ('dashboard');

        //PATIENT
        Route::get('/patientprofile/{user}', 'App\Http\Controllers\PatientProfileController@index')->name('patientprofile.show');
        Route::get('/patientprofile/{user}/edit', 'App\Http\Controllers\PatientProfileController@edit')->name('patientprofile.edit');

        Route::resource('patientmedicalhistory', MedicalHistoryController::class);

        //DOCTOR
        Route::get('/doctorprofile/{user}', 'App\Http\Controllers\DoctorProfileController@index')->name('doctorprofile.show');
        Route::get('/doctorprofile/{user}/edit', 'App\Http\Controllers\DoctorProfileController@edit')->name('doctorprofile.edit');
    });

    //Create Profile can only be visited once
    Route::group(['middleware' => ['createprofileonce']], function () {
        Route::get('/patientprofile/{user}/create', 'App\Http\Controllers\PatientProfileController@create')->name('patientprofile.create');
        Route::get('/doctorprofile/{user}/create', 'App\Http\Controllers\DoctorProfileController@create')->name('doctorprofile.create');
    });
});


Route::patch('/patientprofile/{user}', 'App\Http\Controllers\PatientProfileController@update')->name('patientprofile.update');
Route::patch('/doctorprofile/{user}', 'App\Http\Controllers\DoctorProfileController@update')->name('doctorprofile.update');


require __DIR__.'/auth.php';

