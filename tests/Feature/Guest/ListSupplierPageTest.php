<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListSupllierPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('/list-suppliers');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('/list-suppliers');

        $response->assertSee('The Pet Family');
    }
    public function test_listSupllier_div()
    {
        $response = $this->get('/list-suppliers');

        $response->assertSee('Danh Sách Nhà Cung Cấp');
    }
    public function test_searchSupplier_div()
    {
        $response = $this->get('/list-suppliers');

        $response->assertSee('Tìm Kiếm Tên Nhà Cung Cấp');
    }
     public function test_searchSupplier_button()
    {
        $response = $this->get('/list-suppliers');

        $response->assertSee('button-search-supplier');

    }
    public function test_listSupplierItem_div()
    {
        $response = $this->get('/list-suppliers');

        $response->assertSee('list-group-item');
    }

    
} 