<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfilePageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
        $response->assertStatus(200);
        $this->call('GET', '/auth/logout');
    }
    public function test_title()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);

        $response->assertSee('The Pet Family');
        $this->call('GET', '/auth/logout');
    }
    public function test_editProfile_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);

        $response->assertSee('Thay Đổi Hồ Sơ Của Bạn');
        $this->call('GET', '/auth/logout');
    }
    public function test_updateAvatar_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('update-avatar');
        $response->assertSee('Thay đổi ảnh đại diện khác');
        $this->call('GET', '/auth/logout');
    }
     public function test_notification_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('alert alert-info alert-dismissable');
        $this->call('GET', '/auth/logout');
    }
    public function test_userProfile_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('Thông Tin Người Dùng');
        $this->call('GET', '/auth/logout');
    }
    public function test_EditProfileForm_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('Họ và Tên');
        $response->assertSee('Email:');
        $response->assertSee('Giới Tính');
        $response->assertSee('SDT');
        $this->call('GET', '/auth/logout');
    }
    public function test_bankAccountForm_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('Tên Ngân Hàng:');
        $response->assertSee('Tên Chủ Tài Khoản:');
        $response->assertSee('Số Tài Khoản:');
        $response->assertSee('Chi Nhánh:');
        $this->call('GET', '/auth/logout');
    }
     public function test_changePass_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');
        $this->followRedirects($response);
        
        $response->assertSee('Mật Khẩu Hiện Tại:');
        $response->assertSee('Mật Khẩu Mới:');
        $response->assertSee('Xác Nhận Mật Khẩu Mới:');
        $response->assertSee('Đổi Mật Khẩu');
        $this->call('GET', '/auth/logout');
    }
}    