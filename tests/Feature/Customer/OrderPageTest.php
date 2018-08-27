<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPageTest extends TestCase
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
        $response = $this->call('GET', 'dat-hang');

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
        $response = $this->call('GET', 'dat-hang');
        $this->followRedirects($response);

        $response->assertSee('The Pet Family');
        $this->call('GET', '/auth/logout');
    }
    public function test_orderInfor_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'dat-hang');
        $this->followRedirects($response);

        $response->assertSee('Đặt hàng');
        $this->call('GET', '/auth/logout');
    }
    public function test_inputInfor_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'dat-hang');
        $this->followRedirects($response);
        
        $response->assertSee('Họ tên');
        $response->assertSee('Giới tính');
        $response->assertSee('Địa chỉ nhận hàng');
        $this->call('GET', '/auth/logout');
    }
    public function test_OrderInfor1_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'dat-hang');
        $this->followRedirects($response);
        
        $response->assertSee('Đơn hàng của bạn');
        $response->assertSee('Tổng tiền:');
        $this->call('GET', '/auth/logout');
    }
    public function test_payment_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'dat-hang');
        $this->followRedirects($response);
        
        $response->assertSee('Hình thức thanh toán');
        $response->assertSee('Thanh toán khi nhận hàng');
        $response->assertSee('Chuyển khoản');
        $this->call('GET', '/auth/logout');
    }
}    