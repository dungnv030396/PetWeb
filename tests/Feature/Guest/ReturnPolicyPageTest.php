<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReturnPolicyPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('returnPolicy');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('returnPolicy');

        $response->assertSee('The Pet Family');
    }
    public function test_returnPolicy_div()
    {
        $response = $this->get('returnPolicy');

        $response->assertSee('Chính Sách Hoàn Trả');
    }
    public function test_returnPolicyContent_div()
    {
        $response = $this->get('returnPolicy');

        $response->assertSee('Đối với thú nuôi');
        $response->assertSee('Đối với sản phẩm');
        $response->assertSee('Điều kiện đổi hàng');
        $response->assertSee('Phí đổi hàng');
        $response->assertSee('Quý Khách Hàng lưu ý');
    }
    public function test_logo_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('logo.png');
    }
    public function test_search_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('fa fa-search');
    } 
    public function test_signin_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Đăng nhập');
    }
    public function test_register_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Đăng kí');
    }
    public function test_cart_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Giỏ hàng');
    }
    public function test_pet_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Vật nuôi');
    }
    public function test_product_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Sản phẩm');
    }
    public function test_service_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Dịch vụ cho vật nuôi');
    }
    public function test_supplier_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Nhà cung cấp');
    }
    public function test_introduct_div()
    {
        $response = $this->get('/returnPolicy');

        $response->assertSee('Giới thiệu');
    }
    

}    