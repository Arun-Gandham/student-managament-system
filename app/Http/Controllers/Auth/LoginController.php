<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        $prefix = request()->segment(1);
        return $prefix.RouteServiceProvider::HOME;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('student.dashboard.index');
        }
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('subdomain.login');
    }

    public function login(Request $request)
    {

        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        $subdomain = $request->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        $schoolStrongIdEnv = isset($subdomains[$subdomain]) ? $subdomains[$subdomain] : 0;
        $school_id = Schools::where('subdomain_id',$schoolStrongIdEnv)->select('id','school_favicon')->first();
        if(env('SUPER_ADMIN_EMAIL') != $request->email) $credentials['school_id'] = $school_id->id;
        if (Auth::attempt($credentials)) {
            // Authentication successful
            if($school_id->school_favicon != "") session()->put('SCHOOL_FAVICON_PATH',$school_id->school_favicon);
            $request->session()->put('subdomain', $subdomain);
            return redirect($this->redirectTo());
        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
