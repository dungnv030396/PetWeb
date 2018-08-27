<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductByCategoryPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertSee('The Pet Family');
    }
     public function test_asidemenu_div()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertSee('aside-menu');
        $response->assertSee('Vật nuôi');
       
    }
    public function test_asidemenu2_div()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        
        $response->assertSee('Sản phẩm');
        $response->assertSee('Dịch vụ cho vật nuôi');
    }
     public function test_newProduct_div()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertSee('Sản phẩm mới');

    }
     public function test_otherProduct_div()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertSee('Sản phẩm khác');
    }
    public function test_pagination_div()
    {
        $response = $this->get('san-pham-theo-loai/1?');

        $response->assertSee('role="navigation"');
    }
}    