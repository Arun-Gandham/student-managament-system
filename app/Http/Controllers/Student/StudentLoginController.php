<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $auth;
    protected function redirectTo()
    {
        $prefix = request()->segment(1);
        return $prefix . RouteServiceProvider::HOME;
    }

    public function __construct()
    {
        $this->auth = Auth::guard('student');
    }


    public function showLoginForm()
    {
        if (!$this->auth->guest()) return redirect()->route('student.dashboard.index');
        if (Auth::user()) return redirect()->route('login');
        return view('student.auth.login');
    }


    public function login(Request $request)
    {
        $credentials['registration_number'] = $request->registration_number;
        $credentials['password'] = $request->password;
        $subdomain = $request->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        $schoolStrongIdEnv = isset($subdomains[$subdomain]) ? $subdomains[$subdomain] : 0;
        $school_id = Schools::where('subdomain_id',$schoolStrongIdEnv)->select('id','school_favicon')->first();
        $credentials['school_id'] = $school_id->id;

        if ($this->auth->attempt($credentials)) {
            // Authentication successful
            if($school_id->school_favicon != "") session()->put('SCHOOL_FAVICON_PATH',$school_id->school_favicon);
            return redirect($this->redirectTo());
        } else {
            // Authentication failed
            return back()->withErrors([
                'registration_number' => 'Invalid registration number or password',
            ]);
        }
    }


    public function logout()
    {
        Auth::guard('student')->logout();
        session()->flush();
        return redirect()->route('student.login');
    }
}
