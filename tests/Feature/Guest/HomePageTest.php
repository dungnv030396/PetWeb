<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home_div()
    {
     $this->get('/index')->assertSee('Trang chủ'); 
    }
    public function test_status()
    {
        $response = $this->get('/index');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('/index');

        $response->assertSee('The Pet Family');
    }
    public function test_logo_div()
    {
        $response = $this->get('/index');

        $response->assertSee('logo.png');
    }
    public function test_search_div()
    {
        $response = $this->get('/index');

        $response->assertSee('fa fa-search');
    }    
    public function test_slide_div()
    {
        $response = $this->get('/index');

        $response->assertSee('slides/banner1.jpg');
    }
    public function test_slide2_div()
    {
        $response = $this->get('/index');

        $response->assertSee('slides/banner2.jpg');
    }
    public function test_slide3_div()
    {
        $response = $this->get('/index');

        $response->assertSee('slides/banner3.jpg');
    }
    public function test_signin_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Đăng nhập');
    }
    public function test_register_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Đăng kí');
    }
    public function test_cart_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Giỏ hàng');
    }
    public function test_pet_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Vật nuôi');
    }
    public function test_product_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Sản phẩm');
    }
    public function test_service_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Dịch vụ cho vật nuôi');
    }
    public function test_supplier_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Nhà cung cấp');
    }
    public function test_introduct_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Giới thiệu');
    }
    public function test_listpet_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Thêm giỏ hàng');
    }
    public function test_detail_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Chi tiết');
    }
    public function test_saleproduct_div()
    {
        $response = $this->get('/index');

        $response->assertSee('Sản phẩm đang khuyến mại');
    }
    
}
