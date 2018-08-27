<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginModeratorPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('login/moderator');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('The Pet Family | Moderator | Login');
    }
    public function test_logo_div()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('TPF');
        $response->assertSee('logo-name');
    }
    public function test_notification_div()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('Chào mừng đã tới TPF');
    }
    public function test_email_div()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('Địa Chỉ Email');
    }
    public function test_pass_div()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('Mật Khẩu');
    }
    public function test_submit_div()
    {
        $response = $this->get('login/moderator');

        $response->assertSee('Đăng Nhập');
    }
    public function test_message_whenInvalidAccount()
    {   
         $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => '04355@fpt.edu.vn',
        'password' => '12345a',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Email hoặc mật khẩu không chính xác hoặc đã bị khóa');
    }
     
     
}    