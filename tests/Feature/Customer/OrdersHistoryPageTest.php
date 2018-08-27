<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersHistoryPageTest extends TestCase
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
        $response = $this->call('GET', 'customer/ordershistory/1');

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
        $response = $this->call('GET', 'customer/ordershistory/1');
        $this->followRedirects($response);

        $response->assertSee('The Pet Family');
        $this->call('GET', '/auth/logout');
    }
    public function test_orderhistory_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'customer/ordershistory/1');
        $this->followRedirects($response);

        $response->assertSee('Danh Sách Lịch Sử Mua Hàng');
        $this->call('GET', '/auth/logout');
    }
    public function test_searchbar_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'customer/ordershistory/1');
        $this->followRedirects($response);
        
        $response->assertSee('search-supplier');
        $this->call('GET', '/auth/logout');
    }
}    