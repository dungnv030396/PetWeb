<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPageTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
    public function test_status()
    {
        $response = $this->get('contact');

        $response->assertStatus(200);
    }
    public function test_title()
    {
        $response = $this->get('contact');

        $response->assertSee('The Pet Family');
    }
    public function test_map_div()
    {
        $response = $this->get('contact');

        $response->assertSee('beta-map');
    }
    public function test_sampleContact_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Mẫu Liên Hệ');
    }
    public function test_contact_form_div()
    {
        $response = $this->get('contact');

        $response->assertSee('contact-form');
    }
    public function test_inputname_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Tên Của bạn');
    }
    public function test_inputemail_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Địa chỉ email của bạn');
    }
    public function test_inputemail2_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Địa chỉ email của bạn');
    }
    public function test_inputsubject_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Tiêu Đề');
    }
    public function test_submitmessage_button()
    {
        $response = $this->get('contact');

        $response->assertSee('Gửi Thư ');
    }
    public function test_inputmessage_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Nội dung tin nhắn của bạn');
    }
    public function test_address_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Địa Chỉ');
    }
    public function test_question_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Thắc Mắc Kinh Doanh');
    }
    public function test_job_div()
    {
        $response = $this->get('contact');

        $response->assertSee('Việc Làm');
    }
    
}    