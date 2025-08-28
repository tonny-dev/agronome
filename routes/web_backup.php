<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

Route::get('/', function () {
        return redirect  ('/login');
});

//auth routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'show_login'])
->name('show.login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->
name('login');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show_register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//Route::get('/verify', function(){ return view('success_register'); })->middleware('auth')->name('verification.notice');

Route::get('/verify', function(){ return view('success_register'); })->name('verification.notice');

// Route::get('/verify/{id}/{hash}', function(EmailVerificationRequest $request) 
// {$request->fulfill(); return view('success_verify');})->middleware('auth')->name('verification.verify');


Route::get('/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify_redirect'])->name('verification.verify');

// Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return view('success_verify');
// })
// ->middleware(['auth', 'signed'])
// ->name('verification.verify');


Route::get('/success_verify', function () {
     return view('success_verify');
 });


 Route::get('/success_reset', function () {
    return view('success_reset');
})->name('success_reset');


Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
    
                $user->setRememberToken(Str::random(60));
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('success_reset')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');



//farmer routes
Route::get('/farmer_dashboard', [App\Http\Controllers\Farmer\FarmerController::class,'show_dashboard'])->middleware('auth')->name('farmer.farmer_dashboard');
Route::post('/update_profile', [App\Http\Controllers\Farmer\FarmerController::class,'update_profile'] )->name('farmer.update_profile');

Route::post('/get_farm_by_id', [App\Http\Controllers\Farmer\FarmerController::class,'get_farm_by_id'] )->name('farmer.set_current_farm');
Route::put('/update_profile', [App\Http\Controllers\Farmer\FarmerController::class,'update_profile'] )->name('farmer.update_profile');


// Route to my_profile page added by george 
Route::get('/my_profile', function(){ return view('farmer.farmer_profile'); })->middleware('auth')->name('farmer_profile');

//Route to view account settings
// Route::get('/my_account', App\Http\Livewire\ChangePassword::class)->name('my_account');
Route::get('/my_account', function(){ return view('farmer/change_password'); })->middleware('auth')->name('my_account');

//Route to view farm details
Route::get('/farm.list', function(){ return view('farm.farm_list'); })->middleware('auth')->name('farm_list');

// This route is for getting county name when you select farm.
// Will delete it when I have optimized the code
Route::get('getfarmcountyonselect/{id}', [App\Http\Livewire\LwFarmList::class,'getFarmCountyOnSelect']);

//Route to view privacy policy page
Route::get('/privacy_policy', function(){ return view('legalpolicyandtermsofservice.privacy_policy'); })->middleware('auth')->name('privacy_policy');
//Route to view terms and conditions page
Route::get('/terms_and_conditions', function(){ return view('legalpolicyandtermsofservice.terms_and_conditions'); })->middleware('auth')->name('terms_and_conditions');

Route::get('/add_farm_success', function(){ return view('success/add_farm_success'); })->middleware('auth');


// Maybe place these in a locations controller at some point

Route::get('/get_constituency_coords', [App\Http\Controllers\Farmer\FarmerController::class,'get_constituency_coords'] )->name('farmer.get_constituency_coords');
Route::get('/get_ward_coords', [App\Http\Controllers\Farmer\FarmerController::class,'get_ward_coords'] )->name('farmer.get_ward_coords');
Route::get('/get_landmark_coords', [App\Http\Controllers\Farmer\FarmerController::class,'get_landmark_coords'] )->name('farmer.get_landmark_coords');


//farm routes
Route::get('/farm', [App\Http\Controllers\Farm\FarmController::class,'show_farm'])->name('farm.farm_dashboard');
Route::get('/get_fields_from_farm', [App\Http\Controllers\Farm\FarmController::class,'get_fields_from_farm'])->name('farm.get_fields_from_farm');

//soil routes
Route::get('/soil_dashboard', function () {   return view('soil.soil_dashboard');})->name('soil_dashboard')->middleware('auth');
Route::get('/soil_results', function () {   return view('soil.soil_results');})->name('soil_results')->middleware('auth');


//crop routes

Route::get('/crop_dashboard', function () {   return view('crop.crop_dashboard');})->name('crop_dashboard')->middleware('auth');


//Route::get('/crop', [App\Http\Controllers\Crop\CropController::class,'show_crops'])->name('crop list');
Route::get('/crop_farm_list', [App\Http\Controllers\Crop\CropController::class,'show_crop_farm_list'])->name('crop_farm_list');
Route::get('/crop_farm_details', [App\Http\Controllers\Crop\CropController::class,'show_crop_farm_details'])->name('crop_farm_details');
Route::get('/monitoring', function(){ return view('crop.monitoring');})->name('monitoring');


//test routes

Route::get('/crop_selector_test', function(){ return view('crop.selection');})->name('crop_selection');

Route::get('/farm_fed_vanilla', function(){ return view('fed_farm');})->name('vanilla_farm');

Route::get('/fed_crop_vanilla', function(){ return view('fed_crop_vanilla');}); 

Route::get('/fed_soil_vanilla', function(){ return view('fed_soil_vanilla');}); 

//livewire routes

//Route::livewire('/plant_new_crop','lw-crop-farm');

//Route::get('/plant_crop' , App\Http\Livewire\LwCropFarm::class);






















