<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Beneficiary;
use App\Models\Gecd;
use App\Models\Gecmnre;
use App\Models\Reia;
use Hash;
use Redirect,Session;

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
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:mnre')->except('logout');
        $this->middleware('guest:state-implementing-agency')->except('logout');
        $this->middleware('guest:localbody')->except('logout');
        $this->middleware('guest:installer')->except('logout');
        $this->middleware('guest:reia')->except('logout');
        $this->middleware('guest:inspector')->except('logout');
        $this->middleware('guest:developer')->except('logout');
        $this->middleware('guest:seci')->except('logout');
        $this->middleware('guest:gecdeveloper')->except('logout');
    }



    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // dd($request);
        switch ($request->user_type) {
            case 'MNRE':
                $this->redirectTo = '/mnre';
                break;
            case 'GECMNRE':
                    $this->redirectTo = '/gecmnre';
                    break;
            case 'STATEIMPLEMENTINGAGENCY':
                $this->redirectTo = '/state-implementing-agency';
                break;
            case 'REIA':
                $this->redirectTo = '/reia';
                break;
            case 'BENEFICIARY_EMAIL':
                $this->redirectTo = '/developer';
                break;
            case 'BENEFICIARY_MOBILE':
                $this->redirectTo = '/developer';
                break;
            case 'SECI':
                $this->redirectTo = '/seci';
                break;
            case 'GECDEVELOPER_EMAIL':
                $this->redirectTo = '/gecdeveloper';
                break;
            case 'GECDEVELOPER_MOBILE':
                $this->redirectTo = '/gecdeveloper';
                break;
            default:
                $this->redirectTo = '/home';
                break;
        }
      
        
        // if($request->user_type=='STATEIMPLEMENTINGAGENCY' && $request->user_type!='INSTALLER')
        // {
            // Decrypt Password
            $random_session_id1 = Session::get('random_session_id1');
            $random_session_id2 = Session::get('random_session_id2');

            // dd($random_session_id2.'============'.$random_session_id1);
            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv =  hex2bin("abcdef9876543210abcdef9876543210");   
            $decryptedId = openssl_decrypt($request->email, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $email = trim($decryptedId);
            $email =  str_replace($random_session_id1,"",$email);
            $email =  str_replace($random_session_id2,"",$email);
            $decryptedPwd = openssl_decrypt($request->password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $password = trim($decryptedPwd);
            $password =  str_replace($random_session_id1,"",$password);
            $password =  str_replace($random_session_id2,"",$password);
            
            $request->merge([
                'email' => $email,
                'password' => $password,
            ]);
            
            // }
            
        
         $this->validator($request);
        if($request->user_type=='BENEFICIARY_MOBILE'){
            if($request->contact=='phone')
            {
                $user = Beneficiary::where('contact_no', $request->get('contact_no'))->first();
                if($request->contact_no == $user->contact_no) {
                    $this->validator($request);
                    $pass=$user->password;
                    $user->password=Hash::make('123456');
                    $user->save();
                    $request['password']='123456';
                    //dd($user);
                    if($this->guard($request)->attempt($request->only('contact_no','password'), $request->filled('remember'))){
                        //Authentication passed...
                        $user1 =Beneficiary::where('contact_no', $request->contact_no)->first();
                        $user1->password=$pass;
                        $user1->save();
                        return redirect($this->redirectTo);
                    }
                } 
            }
        }
         
        if($request->user_type=='GECDEVELOPER_MOBILE'){
            if($request->contact=='phone')
            {
                // dd($request);
                $user = Gecd::where('contact_no', $request->get('contact_no'))->first();
                if($request->contact_no == $user->contact_no) {
                    
                    $this->validator($request);
                    $pass=$user->password;
                    $user->password=Hash::make('123456');
                    $user->save();
                    $request['password']='123456';
                    //dd($user);
                    if($this->guard($request)->attempt($request->only('contact_no','password'), $request->filled('remember'))){
                        //Authentication passed...
                        $user1 =Gecd::where('contact_no', $request->contact_no)->first();
                        $user1->password=$pass;
                        $user1->save();
                        $url=urlencode($this->redirectTo);
                        return response()->json(['status' => 'success','message'=>'Login Successful','url'=>$url,'redirect'=>'yes']); 
                        return redirect($this->redirectTo);
                    }
                } 
            }
        }
        //dd($request);
        // $this->validator($request);
        // return response()->json(['status' => 'success','message'=>'Login Successful','url'=>'','redirect'=>'yes']); 
        // if ($this->validator($request)->fails()){   //check all validations are fine, if not then redirect and show error messages
            
        //     return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        // }
        //check if the user has too many login attempts.
       
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }
      
        if($this->guard($request)->attempt($request->only('email','password'), $request->filled('remember'))){
            //Authentication passed...
            // $url=urlencode($this->redirectTo);
            // return response()->json(['status' => 'success','message'=>'Login Successful','url'=>$url,'redirect'=>'yes']); 
            return redirect($this->redirectTo);
        }
        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);
        //Authentication failed...
        return $this->sendFailedLoginResponse($request);
    }
    
         
    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
    
        $rules = [
                    'email'    => 'required|email|exists:mnre_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
        switch ($request->user_type) {
            case 'MNRE':
                $rules = [
                    'email'    => 'required|email|exists:mnre_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'GECMNRE':
                $rules = [
                    'email'    => 'required|email|exists:gec_mnre_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'STATEIMPLEMENTINGAGENCY':
                $rules = [
                    'email'    => 'required|email|exists:state_implementing_agency_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
            case 'REIA':
                $rules = [
                    'email'    => 'required|email|exists:reias|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
            case 'LOCALBODY':
                $rules = [
                    'email'    => 'required|email|exists:localbody_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'INSTALLER':
                $rules = [
                    'email'    => 'required|email|exists:installers|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'INSPECTOR':
                $rules = [
                    'email'    => 'required|email|exists:inspectors|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'BENEFICIARY_EMAIL':
                $rules = [
                    'email'    => 'required|email|exists:beneficiary|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'BENEFICIARY_MOBILE':
                $rules = [
                    'contact_no' => 'required',
                    'otp' => 'required',
                ];
                break;
            case 'SECI':
                $rules = [
                    'email'    => 'required|email|exists:seci|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
            case 'GECDEVELOPER_EMAIL':
                $rules = [
                    'email'    => 'required|email|exists:gecd_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
            case 'GECDEVELOPER_MOBILE':
                $rules = [
                    'contact_no' => 'required',
                    'otp' => 'required',
                ];
                break;
            default:
                $rules = [
                    'email'    => 'required',
                    'password' => 'required',
                ];
                break;
        }
        if(!env('DEV_ENVIRONMENT'))
            $rules['captcha'] = 'required|captcha';
        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
            'captcha.captcha' => 'Invalid captcha',
            'user_type.required' => 'The user type field is requried'
        ];
        //validate the request.
        // dd($rules);
        $request->validate($rules, $messages);
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard($request)
    {
        // dd($request);
        switch ($request->user_type) {
            case 'MNRE':
                return Auth::guard('mnre');
                break;
            case 'GECMNRE':
                return Auth::guard('gecmnre');
                break;
            case 'STATEIMPLEMENTINGAGENCY':
                return Auth::guard('state-implementing-agency');
                break;
            case 'REIA':
                return Auth::guard('reia');
                break;
            case 'LOCALBODY':
                return Auth::guard('localbody');
                break;
            case 'INSTALLER':
                return Auth::guard('installer');
                break;
            case 'INSPECTOR':
                return Auth::guard('inspector');
                break;
            case 'BENEFICIARY_MOBILE':
                return Auth::guard('developer');
                break;
            case 'BENEFICIARY_EMAIL':
                return Auth::guard('developer');
                break;
            case 'SECI':
                return Auth::guard('seci');
                break;
            case 'GECDEVELOPER_MOBILE':
                return Auth::guard('gecdeveloper');
                break;
            case 'GECDEVELOPER_EMAIL':
                return Auth::guard('gecdeveloper');
                break; 
            default:
                return Auth::guard();
                break;
        }
    }
    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        if(Auth::guard('mnre')->check()){
            Auth::guard('mnre')->logout();
        }elseif(Auth::guard('gecmnre')->check()){
            Auth::guard('gecmnre')->logout();
        }elseif(Auth::guard('state-implementing-agency')->check()){
            Auth::guard('state-implementing-agency')->logout();
        }elseif(Auth::guard('localbody')->check()){
            Auth::guard('localbody')->logout();
        }elseif(Auth::guard('reia')->check()){
            Auth::guard('reia')->logout();
        }elseif(Auth::guard('installer')->check()){
            Auth::guard('installer')->logout();
        }elseif(Auth::guard('inspector')->check()){
            Auth::guard('inspector')->logout();
        }elseif(Auth::guard('developer')->check()){
            Auth::guard('developer')->logout();
        }elseif(Auth::guard('seci')->check()){
            Auth::guard('seci')->logout();
        }elseif(Auth::guard('gecdeveloper')->check()){
            Auth::guard('gecdeveloper')->logout();
        }else{
            Auth::guard()->logout();
        }
        // $url = urlencode('/');
        // return response()->json(['status' => 'success','message'=>'Logout successfuly!','url'=>$url]);  
        return redirect()->route('home')->with('status','Admin has been logged out!');
    }
}