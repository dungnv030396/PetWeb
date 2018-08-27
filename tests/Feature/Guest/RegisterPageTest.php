
<?php


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('register');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('register');

        $response->assertSee('The Pet Family');
    }
    public function test_signupForm_div()
    {
        $response = $this->get('register');

        $response->assertSee('name="signup"');
    }
    public function test_name_div()
    {
        $response = $this->get('register');

        $response->assertSee('Họ và Tên');
    }
    public function test_Email_div()
    {
        $response = $this->get('register');

        $response->assertSee('Email');
    }
    public function test_pass_div()
    {
        $response = $this->get('register');

        $response->assertSee('Mật Khẩu');
    }
    public function test_confirmPass_div()
    {
        $response = $this->get('register');

        $response->assertSee('Xác Nhận Mật Khẩu ');
    }
    public function test_gender_div()
    {
        $response = $this->get('register');

        $response->assertSee('Giới Tính ');
    }
    public function test_sdt_div()
    {
        $response = $this->get('register');

        $response->assertSee('Số Điện Thoại');
    }
    public function test_address_div()
    {
        $response = $this->get('register');

        $response->assertSee('Địa Chỉ');
    }
    public function test_submit_btn()
    {
        $response = $this->get('register');

        $response->assertSee('value="Đăng Ký"');
    }
   
}    