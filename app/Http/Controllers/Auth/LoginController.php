<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public $visit_no=0;
 
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Got rid of laravel's default handling because of too much magic
    |
    */



    public function login(Request $request)
    {        
        $this->middleware('auth')->except(['logout', 'success_verify']);
        
        $credentials = $this->credentials($request);
        $remember = $request->boolean('remember');
        
        if (Auth::attempt($credentials, $remember))
        {
            $request->session()->regenerate();
            $this->visit_no = ++Auth::user()->visit_no; 

            // Update visit count and last login
            DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'visit_no' => $this->visit_no,
                'last_login_at' => now()
            ]);

            // Store recent user info in cookie for quick access
            $this->storeRecentUser($request->get('email'), Auth::user()->name);

            return redirect()->intended('farmer_dashboard');
        }
                
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }


    protected function credentials(Request $request)
    {
        if(stripos($request->get('email'),'@'))
        {
            return ['email'=>$request->get('email'),'password'=>$request->get('password')];
        }     

        return ['mobile' => $request->get('email'), 'password'=>$request->get('password')];
    }

    /**
     * Store recent user information in cookie for quick login access
     */
    protected function storeRecentUser($identifier, $name)
    {
        $recentUsers = $this->getRecentUsers();
        
        // Remove if already exists
        $recentUsers = array_filter($recentUsers, function($user) use ($identifier) {
            return $user['identifier'] !== $identifier;
        });
        
        // Add to beginning of array
        array_unshift($recentUsers, [
            'identifier' => $identifier,
            'name' => $name,
            'last_login' => now()->toISOString()
        ]);
        
        // Keep only last 5 users
        $recentUsers = array_slice($recentUsers, 0, 5);
        
        // Store in cookie for 30 days
        Cookie::queue('recent_users', json_encode($recentUsers), 43200); // 30 days
    }

    /**
     * Get recent users from cookie
     */
    public function getRecentUsers()
    {
        $recentUsersJson = Cookie::get('recent_users');
        return $recentUsersJson ? json_decode($recentUsersJson, true) : [];
    }

    public function show_login(Request $request)
    {
        $recentUsers = $this->getRecentUsers();
        return view('auth.login', compact('recentUsers'));
    }


    public function logout(Request $request) 
    {      
        // Store current user info before logout for recent users
        if (Auth::check()) {
            $this->storeRecentUser(
                Auth::user()->email ?? Auth::user()->mobile, 
                Auth::user()->name
            );
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();    
        
        return redirect('/')->with('message', 'Successfully logged out');
    }

    /**
     * Clear recent users from cookie
     */
    public function clearRecentUsers(Request $request)
    {
        Cookie::queue(Cookie::forget('recent_users'));
        return back()->with('message', 'Recent users cleared');
    }









}