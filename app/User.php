<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

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
  public function updateProfile(){
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
          'password' => 'required|confirmed|digits_between:6,15',
          'phonenumber' => 'required|digits_between:10,15|numeric',
          'address' => 'required'
      ],
          [
              'password.digits_between' => 'Mật khẩu phải từ 6-15 kí tự!',
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
}
