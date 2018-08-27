<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailProductPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('The Pet Family');
    }
    public function test_detailProduct_div()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('Thông tin chi tiết sản phẩm');
    }
    public function test_detailProduct1_div()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('storage/products/');
        $response->assertSee('Số lượng:');
        $response->assertSee('fa fa-shopping-cart');
    }
    public function test_detailProduct2_div()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('Mô tả sản phẩm');
        $response->assertSee('Bình Luận');
        $response->assertSee('Thêm Bình Luận');
        $response->assertSee('Báo cáo sản phẩm');
    }
     public function test_similarProduct_div()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('Sản phẩm tương tự');
    }
    public function test_newProduct_div()
    {
        $response = $this->get('chi-tiet-san-pham/1');

        $response->assertSee('Sản phẩm mới');
    }
}    