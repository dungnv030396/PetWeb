<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrivacyPolicyPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('privacyPolicy');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('privacyPolicy');

        $response->assertSee('The Pet Family');
    }
     public function test_privacyPolicy_div()
    {
        $response = $this->get('privacyPolicy');

        $response->assertSee('Chính Sách Bảo Mật');
    }
    public function test_privacyPolicyContent_div()
    {
        $response = $this->get('privacyPolicy');

        $response->assertSee('Thu thập thông tin cá nhân');
        $response->assertSee('Bảo Mật');
        $response->assertSee('Quyền lợi khách hàng');
    }
    public function test_logo_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('logo.png');
    }
    public function test_search_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('fa fa-search');
    } 
    public function test_signin_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Đăng nhập');
    }
    public function test_register_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Đăng kí');
    }
    public function test_cart_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Giỏ hàng');
    }
    public function test_pet_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Vật nuôi');
    }
    public function test_product_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Sản phẩm');
    }
    public function test_service_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Dịch vụ cho vật nuôi');
    }
    public function test_supplier_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Nhà cung cấp');
    }
    public function test_introduct_div()
    {
        $response = $this->get('/privacyPolicy');

        $response->assertSee('Giới thiệu');
    }
    
}    