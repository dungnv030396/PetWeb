<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
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
    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
  public function listSupplier(){
      $user = User::where('delete_flag',0)
          ->where('roleId',2)->latest()->paginate(10);
      $allUser = User::all()->where('delete_flag',0)
          ->where('roleId',2);
      $number = count($allUser);
      return [
          'user' =>$user,
          'number' => $number
      ];
  }
  public function searchByName(){
      $name = \request('name');
      $user = User::where('name','like','%'.$name. '%')->where('roleId',2)->where('delete_flag',0)->latest()->paginate(10);
      $number = count($user);
      return [
          'user' => $user,
          'number' =>$number
      ];
  }
  public function updateProfile($th){
      $th->validate(\request(), [
          'mem_name' => 'required',
          'emailid' => 'required|email',
          'phonenumber' => 'required|digits_between:10,15|numeric',
          'address' => 'required',
          'card_number' => 'required|numeric'
      ],
          [
              'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
              'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!',
              'card_number.numeric' => 'Số tài khoản không chưa kí tự khác chữ số!'
          ]);
      $id = Auth::user()->id;
      $user = User::find($id);
      $user->name = request('mem_name');
      $user->email = request('emailid');
      $user->phoneNumber = request('phonenumber');
      $user->address = request('address');
      $user->bank_name = request('bank_name');
      $user->bank_username = request('bank_username');
      $user->card_number = request('card_number');
      $user->bank_branch = request('bank_branch');
      $user->save();
  }

  public function getCurrentUser(){
      return Auth::user();
  }

  public function isLogin(){
      $isLogin = false;
      if(!empty($this->getCurrentUser())){
          $isLogin = true;
      }
      return $isLogin;
  }
  public function register($th){
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
      $user->name = request('mem_name');
      $user->email = request('emailid');
      $user->password = bcrypt(request('password'));
      $user->phoneNumber = request('phonenumber');
      $user->gender = \request('gender');
      $user->address = request('address');
      $user->avatar = 'user-default.png';
      $user->save();
  }
  public function resetPass(){
      $user = User::where('email',\request('email'))->get();
      if (count($user)>0){
          $data = array('name' => $user[0]->name,'link' => 'http://localhost:8080/thepetfamily/public/changePassByMail/'.$user[0]->id);
      }else{
          return back()->with('emailNotFound','Địa Chỉ Email không tồn tại!');
      }
      Mail::send('clientViews.emails.mailForgotPass', $data, function ($message) {
          $message->to(\request('email'))
              ->subject('The Pet Family - Khôi Phục Mật Khẩu');
          $message->from('thepetfamilyteam@gmail.com');
      });
  }
  public function changePassByMail($th){
      $id = \request('id');
      $user = User::find($id);
      $th->validate(\request(),[
          'password' => 'required|confirmed|between:6,15',
      ],[
          'password.between' => 'Mật khẩu phải từ 6-15 kí tự!',
          'password.confirmed' => 'Mật Khẩu xác nhận không chính xác',
      ]);

      $user->password = bcrypt(\request('password'));
      $user->save();

  }
}
