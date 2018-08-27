<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductbyWarehouseTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
   public function test_status()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertStatus(200);
        $this->call('GET', 'logout/moderator');

    }
    public function test_title()
    {
       $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('The Pet Family');;
        $this->call('GET', 'logout/moderator');
    }
    public function test_sidebar_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Sản phẩm cần nhận');
        $this->call('GET', 'logout/moderator');
    }
     public function test_name1_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('Kho Hà Nội');
        $this->call('GET', 'logout/moderator');
    }
    public function test_notification_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chào Mừng Đến Trang Quản Lí Của Quản Trị Viên');
        $this->call('GET', 'logout/moderator');
    }
    public function test_logout_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('fa fa-sign-out');
        $this->call('GET', 'logout/moderator');
    }
    public function test_name_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('Kho Hà Nội');
        $this->call('GET', 'logout/moderator');
    }
    public function test_print_div()
    {   $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('print');
        $this->call('GET', 'logout/moderator');
    }
    public function test_DetailTable_div()
    {   
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('Mã')->assertSee('Khách hàng')->assertSee('Người quản lý');
        $this->call('GET', 'logout/moderator');
    }
     
}    