<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('reset-password-page');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('The Pet Family');
    }
    public function test_icon_div()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('fa fa-lock fa-4x');
    }
    public function test_resetpassword_div()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('Khôi Phục Mật Khẩu?');
    }
   
    public function test_reset_form_div()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('Bạn có thể khôi phục mật khẩu ở đây.');
    }
    public function test_emailInput_div()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('địa chỉ email');
    }
    public function test_submit_btn()
    {
        $response = $this->get('reset-password-page');

        $response->assertSee('btn btn-lg btn-primary btn-block');
    }
}    