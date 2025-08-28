<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/success_verify';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     $this->middleware('auth')->except('success_verify');
     $this->middleware('signed')->only('verify');
     $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify_redirect( EmailVerificationRequest $request)
    {
      
        $request->fulfill();
        return view('success_verify');
    }



// Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return view('success_verify');
// })
// ->middleware(['auth', 'signed'])
// ->name('verification.verify');


// Route::get('/success_verify', function () {
//     return view('success_verify');
// });



}
