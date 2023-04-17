<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
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
        $this->auth = Auth::guard('parent');
    }


    public function showLoginForm()
    {
        if (!$this->auth->guest()) return redirect()->route('parent.dashboard.index');
        if (auth()->user()) return redirect()->route('login');
        return view('parent.auth.login');
    }


    public function login(Request $request)
    {
        $credentials['student_registration_number'] = $request->student_registration_number;
        $credentials['password'] = $request->password;
        $subdomain = $request->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        $schoolStrongIdEnv = isset($subdomains[$subdomain]) ? $subdomains[$subdomain] : 0;
        $school_id = Schools::where('subdomain_id',$schoolStrongIdEnv)->select('id','school_favicon')->first();
        $credentials['school_id'] = $school_id->id;

        if ($this->auth->attempt($credentials)) {
            // Authentication successful
            if($school_id->school_favicon != "") session()->put('SCHOOL_FAVICON_PATH',$school_id->school_favicon);
            $request->session()->put('subdomain', $subdomain);
            return redirect($this->redirectTo());
        } else {
            // Authentication failed
            return back()->withErrors([
                'student_registration_number' => 'Invalid registration number or password',
            ]);
        }
    }


    public function logout()
    {
        $this->auth->logout();
        session()->flush();
        return redirect()->route('parent.login');
    }
}
