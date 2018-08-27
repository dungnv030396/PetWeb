<?php

use Tests\TestCase;
use Tests\ControllerTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginAdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function testVerifyAccount()
    {   
        $this->assertTrue(Auth::attempt(['email' => 'tpfteam1111@gmail.com', 'password' => '123456']));
      
    }
     public function test_Logout()
    {
        $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'tpfteam1111@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Log out');
        $this->call('GET', 'logout/admin');
        // $this->followRedirects($response)->assertSee('Danh sách đơn');
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
        $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'tpfteam1111@gmail.com',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->call('GET', 'logout/admin');
    
    }
    public function testLoginAccountWithWrongPass()
    {   
        $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'tpfteam1111@gmail.com',
        'password' => '12345678',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Email hoặc mật khẩu không chính xác hoặc đã bị khóa');
    }
    public function testLoginAccountWithWrongPass1()
    {   
         $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'tpfteam1111@gmail.com',
        'password' => '12345a',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Email hoặc mật khẩu không chính xác hoặc đã bị khóa');
    }
     public function testLoginAccountWithWrongEmail()
    {   
         $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'dungnqse@fpt.edu.vn',
        'password' => '12345678',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Email hoặc mật khẩu không chính xác hoặc đã bị khóa');
    }
    public function testLoginAccountWithWrongEmail1()
    {  
        $this->get('/login/admin');
        $response = $this->call('POST', '/admin/manage/home', [
        'email' => 'hiepnh04355@fpt.edu.vn',
        'password' => '12345678',
        '_token' => csrf_token()
    ]);
      $this->followRedirects($response)->assertSee('Email hoặc mật khẩu không chính xác hoặc đã bị khóa');
    }
}
