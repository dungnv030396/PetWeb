<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntroductPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('introduce');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('introduce');

        $response->assertSee('The Pet Family');
    }
    public function test_logo_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('logo.png');
    }
    public function test_search_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('fa fa-search');
    } 
    public function test_signin_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Đăng nhập');
    }
    public function test_register_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Đăng kí');
    }
    public function test_cart_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Giỏ hàng');
    }
    public function test_pet_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Vật nuôi');
    }
    public function test_product_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Sản phẩm');
    }
    public function test_service_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Dịch vụ cho vật nuôi');
    }
    public function test_supplier_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Nhà cung cấp');
    }
    public function test_introduct_div()
    {
        $response = $this->get('/introduce');

        $response->assertSee('Giới thiệu');
    }
    
    
}    