<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_changePass()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03562@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-password', [
        'oldpwd' => '123456',
        'password' => '111111',
        'password_confirmation' => '111111',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã thay đổi mật khẩu Thành Công!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_changePass1()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03562@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-password', [
        'oldpwd' => '111111',
        'password' => '123456',
        'password_confirmation' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã thay đổi mật khẩu Thành Công!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_changePass_between()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03562@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-password', [
        'oldpwd' => '123456',
        'password' => '123',
        'password_confirmation' => '123',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Mật khẩu phải từ 6-15 kí tự!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_changePass_confirmed()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03562@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-password', [
        'oldpwd' => '123456',
        'password' => '123111',
        'password_confirmation' => '1211156',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Mật Khẩu xác nhận không chính xác');
        
        $this->call('GET', '/auth/logout');
    }
}    	