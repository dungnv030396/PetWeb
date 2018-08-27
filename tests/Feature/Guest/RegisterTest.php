<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_registerWith_ValidAccount()
    {
        $response = $this->get('register');
        $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã đăng ký tài khoản Thành Công');
        DB::table('users')->where('email', 'se03561@fpt.edu.vn')->delete();
    }
    public function test_registerWith_ValidAccount1()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'sky',
        'emailid' => '03561@fpt.edu.vn',
        'password' => '1111111',
        'password_confirmation' => '1111111',
        'gender' => '1',
        'phonenumber' => '1234447891',
        'address' => 'Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã đăng ký tài khoản Thành Công');
        DB::table('users')->where('email', '03561@fpt.edu.vn')->delete();
    }
    public function test_registerWith_ValidAccount2()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'sky@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã đăng ký tài khoản Thành Công');
        DB::table('users')->where('email', 'sky@fpt.edu.vn')->delete();
    }
    public function test_registerWith_ExistAccount()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Đăng ký không thành công! Email đã tồn tại!xin mời nhập lại');
    }
    public function test_registerWith_ExistAccount1()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '111111',
        'password_confirmation' => '111111',
        'gender' => '2',
        'phonenumber' => '2344231237',
        'address' => 'Hồ Chí Minh',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Đăng ký không thành công! Email đã tồn tại!xin mời nhập lại');
    }
    public function test_registerWith_InvalidPhonenumber_ErrorDigits_between()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '1234',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoại phải có 10-15 chữ số');
    }
    public function test_registerWith_InvalidPhonenumber_ErrorDigits_between1()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [

        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '1234542578901234',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoại phải có 10-15 chữ số');
    }
    public function test_registerWith_InvalidPhonenumber_ErrorNumeric()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123456',
        'gender' => '1',
        'phonenumber' => '123a456789',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoải không chưa kí tự khác chữ số!');
    }
    
    public function test_registerWith_WrongConfirmationPass()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '123456',
        'password_confirmation' => '123',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Mật Khẩu xác nhận không chính xác');
    }
    public function test_registerWith_WrongPass_between()
    {
        $response = $this->get('register');
         $response = $this->call('POST', '/register', [
        'mem_name' => 'abc',
        'emailid' => 'se03561@fpt.edu.vn',
        'password' => '1234',
        'password_confirmation' => '1234',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Hà Nội',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Mật khẩu phải từ 6-15 kí tự!');
    }
    
  
}    