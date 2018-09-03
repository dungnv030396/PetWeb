<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
        $userSocialite = Socialite::driver('facebook')->fields([
            'name',
            'first_name',
            'last_name',
            'email',
            'gender',
            'verified'
        ])->user();
        if($userSocialite->email ==null){
            return back()->withErrors('emailNull','Tài Khoản Facebook chưa liên kết email!');
        }
        $findUserSocialite = User::all()->where('email',$userSocialite->email)->first();
        if($findUserSocialite){
            Auth::login($findUserSocialite);
            return back()->with('facebook');
        }else{
            $user = new User();
            $first_name = $userSocialite->user['first_name'];
            $last_name = $userSocialite->user['last_name'];
            $user->name = $first_name .' '. $last_name;
            $user->email = $userSocialite->email;
            $user->avatar = $userSocialite->avatar;
            $password = str_random(6);
            $user->password = bcrypt($password);
//            $user->password = bcrypt('123456');
            $user->save();

            Auth::login($user);
            return back()->with('facebook');
        }
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
            return redirect(route('trangchu'));
        }else{
            $user = new User();
            $user->name = $userSocialite->name;
            $user->email = $userSocialite->email;
            $user->avatar = $userSocialite->avatar;
            $password = str_random(6);
            $user->password = bcrypt($password);
//            $user->password = bcrypt('123456');
            $user->save();

            Auth::login($user);
            return redirect(route('trangchu'));
        }
    }

}
