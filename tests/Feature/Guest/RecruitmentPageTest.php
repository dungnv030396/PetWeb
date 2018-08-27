<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecruitmentPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('recruitment');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('recruitment');

        $response->assertSee('The Pet Family');
    }
    public function test_recruitment_div()
    {
        $response = $this->get('recruitment');

        $response->assertSee('Tuyển Dụng');
    }
}    