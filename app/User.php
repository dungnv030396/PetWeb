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
}
