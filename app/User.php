<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\City;

class User extends Authenticatable
{
    use Notifiable;

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function subComments()
    {
        return $this->hasMany(SubComment::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->hasOne(UserRole::class, 'id', 'roleId');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'user_id', 'id');
    }

    public function city(){
        return $this->hasOne(City::class,'code','city_code');

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function listSupplier()
    {
        $user = User::where('delete_flag', 0)
            ->where('roleId', 2)->latest()->paginate(10);
        $allUser = User::all()->where('delete_flag', 0)
            ->where('roleId', 2);
        $number = count($allUser);
        return [
            'user' => $user,
            'number' => $number
        ];
    }

    public function searchByName()
    {
        $name = \request('name');
        $user = User::where('name', 'like', '%' . $name . '%')->where('roleId', 2)->where('delete_flag', 0)->latest()->paginate(10);
        $number = count($user);
        return [
            'user' => $user,
            'number' => $number
        ];
    }

    public function updateProfile($th)
    {
        $th->validate(\request(), [
            'mem_name' => 'required',
            'emailid' => 'required|email',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required',
        ],
            [
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!',
            ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $city_name = City::where('code',request('city'))->first()->name;
        $user->name = request('mem_name');
        $user->email = request('emailid');
        $user->phoneNumber = request('phonenumber');
        $user->address = request('address').','.$city_name;
        $user->gender = request('gender');
        $user->city_code = request('city');
        $user->save();
    }

    public function updateUserBankInfo($th){
        $th->validate(\request(), [
            'card_number' => 'numeric|digits_between:12,16'
        ],
            [
                'card_number.digits_between' => 'Số tài khoản phải có 12-16 chữ số!',
                'card_number.numeric' => 'Số tài khoản không chưa kí tự khác chữ số!',
            ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->bank_name = trim(request('bank_name'),' ');
        $user->bank_username = trim(request('bank_username'),' ');
        $user->card_number = trim(request('card_number'),' ');
        $user->bank_branch = trim(request('bank_branch'),' ');
        $user->save();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function isLogin()
    {
        $isLogin = false;
        if (!empty($this->getCurrentUser())) {
            $isLogin = true;
        }
        return $isLogin;
    }

    public function register($th)
    {
        $user = new User();
        $email = User::all()->where('email', \request('emailid'));
        if (count($email) > 0) {
            return back()->withErrors('Đăng ký không thành công! Email đã tồn tại!xin mời nhập lại');
        }
        $th->validate(\request(), [
            'mem_name' => 'required',
            'emailid' => 'required|email',
            'password' => 'required|confirmed|between:6,15',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required'
        ],
            [
                'password.between' => 'Mật khẩu phải từ 6-15 kí tự!',
                'password.confirmed' => 'Mật Khẩu xác nhận không chính xác',
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!'
            ]);
        $city_name = City::where('code',request('city'))->first()->name;
        $user->name = request('mem_name');
        $user->email = request('emailid');
        $user->password = bcrypt(request('password'));
        $user->phoneNumber = trim(request('phonenumber'),' ');
        $user->gender = \request('gender');
        $user->address = request('address').' ,'. $city_name;
        $user->avatar = 'user-default.png';
        $user->city_code = request('city');
        $user->save();
        return back()->with('status','Chúc mừng bạn đã đăng ký tài khoản Thành Công');
    }

    public function resetPass()
    {
        $user = User::where('email', \request('email'))->get();
        if (count($user) > 0) {
//            $data = array('name' => $user[0]->name, 'link' => route('changePassByMail',$user[0]->id));
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 20; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $data = array('name' => $user[0]->name, 'link' => route('changePassByMail',$randomString));
            $password_token = new PasswordToken();
            $password_token->user_id = $user[0]->id;
            $password_token->token = bcrypt($randomString.''.'thepetteam');
            $password_token->save();

//            dd(bcrypt($randomString.''.'thepetteam'));
//            'link' => 'http://localhost:8000/changePassByMail/' . $user[0]->id)
            Mail::send('clientViews.emails.mailForgotPass', $data, function ($message) {
                $message->to(\request('email'))
                    ->subject('The Pet Family - Khôi Phục Mật Khẩu');
                $message->from('thepetfamilyteam@gmail.com');
            });
            return [
                'error' => true,
                'code' => 'resetPassSuccess',
                'message' => 'Khôi phục mật khẩu thành công! Chúng tôi đã gửi email tới địa chỉ email của bạn.'
            ];
        } else {
            return [
                'error' => false,
                'code' => 'emailNotFound',
                'message' => 'Địa Chỉ Email không tồn tại!'
            ];
        }

    }

    public function changePassByMail($th,$user_id)
    {
        $user = User::find($user_id);
        $th->validate(\request(), [
            'password' => 'required|confirmed|between:6,15',
        ], [
            'password.between' => 'Mật khẩu phải từ 6-15 kí tự!',
            'password.confirmed' => 'Mật Khẩu xác nhận không chính xác',
        ]);

        $user->password = bcrypt(\request('password'));
        $user->save();
//        $a = Order::where('payment_id',51)->delete();
        $token = PasswordToken::where('user_id',$user_id)->first();
        if ($token){
            $token->delete();
        }
        return $token;
    }

    public function isSupplier($user)
    {
        return ($user->roleId == 2);
    }

    public function isModerator($user)
    {
        return ($user->roleId == 4);
    }

    public function isAdmin($user)
    {
        return ($user->roleId == 1);
    }

}
