<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuaranteePageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('guarantee');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('guarantee');

        $response->assertSee('The Pet Family');
    }
    
    public function test_guarantee_div()
    {
        $response = $this->get('guarantee');

        $response->assertSee('Chính Sách Bảo Hành');
    }
    public function test_guaranteeContent_div()
    {
        $response = $this->get('guarantee');

        $response->assertSee('I. Điều Kiện Bảo Hành');
        $response->assertSee('II. Cách Thức Bảo Hành');
    }
}    