<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageOrderPageTest extends TestCase
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
        $this->followRedirects($response)->assertStatus(200);
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
        $this->followRedirects($response)->assertSee('The Pet Family');;
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
        $this->followRedirects($response)->assertSee('Danh sách order')->assertSee('Sản phẩm cần nhận');
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
    public function test_nameTable_div()
    {
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('moderator/manage/order-list')->assertSee('text-info')->assertSee('Danh sách đơn hàng');
        $this->call('GET', 'logout/moderator');
    }
    public function test_print_div()
    {   
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('moderator/manage/order-list')->assertSee('print');
        $this->call('GET', 'logout/moderator');
    }
    public function test_table_div()
    {   
        $this->get('/login/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'kazaki_jp@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('moderator/manage/order-list')->assertSee('Mã')->assertSee('Khách hàng')->assertSee('Người quản lý');
        $this->call('GET', 'logout/moderator');
    }
    // public function test_paginate_div()
    // {   
    //     $this->get('/login/moderator');
    //     $response = $this->call('POST', '/moderator/manage/order-list', [
    //     'email' => 'kazaki_jp@gmail.com',
    //     'password' => '123456',
    //     '_token' => csrf_token()
    // ]);
    //     $this->followRedirects($response);
    //     $this->get('moderator/manage/order-list')->assertSee('paginate');
    //     $this->call('GET', 'logout/moderator');
    // }
     
     
}    