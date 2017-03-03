<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\RedditUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Expr\Closure;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Providers\RedditHelperProvider;
use App\Services\RedditHelper;
use App\Utilities\Country;
use Illuminate\Http\Request;
use App\Http\Requests\GetPostRequest;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/schedules';//'/auth/redditLogin';

    protected $loginPath = '/auth/login';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'redditLogin']]);
    }

    public function postLogin(GetPostRequest $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            $user->timezone = $request->input("timezone");
            $user->save();
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'country' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'timezone' => $data['timezone'],
        ]);
    }

    public function redditLogin(Request $request){
        $referrer = null;
        if(!empty($request->input('referrer')) && $request->input('referrer') == 'extension'){
            $referrer = $request->input('referrer');
        }
        $reddit = new RedditHelper();
        $reddit->getToken();
        $user = $reddit->getUser();
        $checkIfExist = User::where('reddit_id', '=', $user->id)->first();
        if($checkIfExist){
            Auth::logout();
            return redirect()->route('exist');
        }else{
            if(isset($user) && !empty($user)){
                $user_id = Auth::user()->id;
                $redditUser = User::where('id', '=', $user_id)->first();
                $redditUser->reddit_username = $user->name;
                $redditUser->reddit_id = $user->id;
                $redditUser->access_token = $reddit->getAccessToken();
                $redditUser->token_type = $reddit->getTokenType();
                $redditUser->refresh_token = $reddit->getRefreshToken();
                $redditUser->save();
                if(!empty($referrer)){
                    return redirect()->route('schedules',['referrer'=>$referrer]);
                }
                return redirect()->route('schedules');
            }
        }
    }

    public function userExist(){
        return view('auth.exist');
    }
    public function getRegister(Request $request, Country $country)
    {
        $referrer = null;
        if(!empty($request->input('referrer')) && $request->input('referrer') == 'extension'){
            $referrer = $request->input('referrer');
        }
        $data = [
            'countries' => $country->all(),
            'referrer' => $referrer
        ];
        return view('auth.register',$data);
    }

    public function postRegister(Request $request)
    {
        $referrer = null;
        if(!empty($request->input('referrer')) && $request->input('referrer') == 'extension'){
            $referrer = $request->input('referrer');
        }
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        if(!empty($referrer)){
            return redirect()->route('schedules',['referrer'=>$referrer]);
        }
        return redirect($this->redirectPath());
    }
}
