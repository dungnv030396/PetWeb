<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProducttobeDeliveredTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   
   public function test_status()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response =$this->get('san-pham-can-giao/danh-sach');
        $response->assertStatus(200);
        $this->call('GET', '/index');

    }
    public function test_title()
    {
       $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response =$this->get('san-pham-can-giao/danh-sach');
        $response->assertSee('The Pet Family');
        $this->call('GET', '/index');
    }
    public function test_sidebar_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Quản lý Sản Phẩm');
        $this->call('GET', '/index');
    }
    public function test_sidebar2_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Quản lý Sản Phẩm');
        $this->call('GET', '/index');
    }
    
    public function test_notification_div()
    {
         $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chào Mới Tới Trang Quản Lí Của Nhà Cung Cấp.');
        $this->call('GET', '/index');
    }
    public function test_logout_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('fa fa-sign-out');
        $this->call('GET', '/index');
    }
    public function test_name_div()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
       $this->followRedirects($response);
        $response =$this->get('supplier/manage/add-product');
        $response->assertSee('Đăng Bán Sản Phẩm');
        $this->call('GET', '/index');
    }
    public function test_print_div()
    {   $this->get('/dang-nhap/moderator');
        $response = $this->call('POST', '/moderator/manage/order-list', [
        'email' => 'dungnqse04355@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $this->get('don-hang/kho/1')->assertSee('print');
        $this->call('GET', 'logout/moderator');
    }
    public function test_tableName_div()
    {   
         $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response =$this->get('san-pham-can-giao/danh-sach');
        $response->assertSee('Danh sách sản phẩm đang thực hiện');
        $this->call('GET', '/index');
    }
     public function test_table_div()
    {   
         $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response =$this->get('san-pham-can-giao/danh-sach');
        $response->assertSee('Mã đơn')->assertSee('Tên Sản Phẩm')->assertSee('Mã SP')->assertSee('Kho');
        $this->call('GET', '/index');
    }
    public function test_button_div()
    {   
         $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('POST', 'loginToManagement', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response =$this->get('san-pham-can-giao/danh-sach');
        $response->assertSee('Hành Động');
        $this->call('GET', '/index');
    }
}    