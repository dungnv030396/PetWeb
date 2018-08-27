<?php

use Tests\TestCase;
use Tests\ControllerTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginSupplierTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function testVerifyAccount()
    {   
        $this->assertTrue(Auth::attempt(['email' => 'hiepnhse03561@fpt.edu.vn', 'password' => '123456']));
      
    }
     public function test_Logout()
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
     public function testVerifyAccountWithFakeAcc()
    {   
        $this->assertFalse(Auth::attempt(['email' => 'aroot@gmail.com', 'password' => '111111']));
      
    }
    public function testVerifyAccountWithFakeAcc1()
    {   
        $this->assertFalse(Auth::attempt(['email' => 'root@gmail.com', 'password' => '211111']));
      
    }
    public function testVerifyAccountWithFakeAcc2()
    {   
        $this->assertFalse(Auth::attempt(['email' => 'hiepnhse03561@gmail.com', 'password' => '123456']));
      
    }
    public function testLoginAccountWithValidAcc()
    {   
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Đăng Xuất');
      $this->assertEquals(302, $response->getStatusCode());
      $this->call('GET', '/auth/logout');
    }
    public function testLoginAccountWithWrongPass()
    {   
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '211111',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Đăng nhập');
    }
    public function testLoginAccountWithWrongPass1()
    {   
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '112345678a',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Đăng nhập');
    }
     public function testLoginAccountWithWrongEmail()
    {   
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'root1@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Đăng nhập');
    }
    public function testLoginAccountWithWrongEmail1()
    {   
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Đăng nhập');
    }
}
