<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShoppingGuidePageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('shoppingGuide');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('shoppingGuide');

        $response->assertSee('The Pet Family');
    }
    public function test_shoppingGuide_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Hướng Dẫn Mua Hàng');
    }
    public function test_shoppingGuideContent_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('I. GIAO HÀNG');
        $response->assertSee('II. THANH TOÁN');
    }
    public function test_image_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('addToCart.png');
    }
    public function test_image1_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('buy.png');
    }
    public function test_logo_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('logo.png');
    }
    public function test_search_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('fa fa-search');
    } 
    public function test_signin_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Đăng nhập');
    }
    public function test_register_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Đăng kí');
    }
    public function test_cart_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Giỏ hàng');
    }
    public function test_introduct_div1()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Giới thiệu');
    }
    public function test_pet_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Vật nuôi');
    }
    public function test_product_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Sản phẩm');
    }
    public function test_service_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Dịch vụ cho vật nuôi');
    }
    public function test_supplier_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Nhà cung cấp');
    }
    public function test_introduct_div()
    {
        $response = $this->get('/shoppingGuide');

        $response->assertSee('Giới thiệu');
    }
    
}    