<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProviderFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFB()
    {
        $userSocialite = Socialite::driver('facebook')->user();

        $findUserSocialite = User::all()->where('email',$userSocialite->email)->first();
        if($findUserSocialite){

            Auth::login($findUserSocialite);
            return redirect()->to('/index')->with('facebook');

        }else{
            $user = new User();
            $user->name = $userSocialite->name;
            $user->email = $userSocialite->email;
            $user->avatar = $userSocialite->avatar;
            $user->password = bcrypt('123456');
            $user->save();

            Auth::login($user);
            return back()->with('facebook');
        }
    }
    public function logoutFacebook()
    {
        Auth::logout();

        return back();
    }

    public function redirectToProviderGM()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGM()
    {
        $userSocialite = Socialite::driver('google')->stateless()->user();


        $findUserSocialite = User::all()->where('email',$userSocialite->email)->first();
        if($findUserSocialite){

            Auth::login($findUserSocialite);
            return Redirect::to('/index')->with('google');

        }else{
            $user = new User();
            $user->name = $userSocialite->name;
            $user->email = $userSocialite->email;
            $user->avatar = $userSocialite->avatar;
            $user->password = bcrypt('123456');
            $user->save();

            Auth::login($user);
            return Redirect::to('/index')->with('google');
        }
    }

}
