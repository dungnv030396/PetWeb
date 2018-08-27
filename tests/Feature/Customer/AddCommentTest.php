<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
   public function test_addComment()
    {
    	$this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', '/chi-tiet-san-pham/1');

        $this->followRedirects($response);
        $response = $this->call('POST', '/them-binh-luan', [
        'addComment' => 'Sản Phẩm tốt, giá cả hợp lý',
        'productId' => '1',
        'uploadMedia' => '',
        '_token' => csrf_token()
    ]);
        $response=$this->followRedirects($response)->assertSee('true');
       // $this->assertEquals($response->message,'true');
        $this->call('GET', '/auth/logout');
    }
    public function test_addCommentWithError()
    {
    	$this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', '/chi-tiet-san-pham/1');

        $this->followRedirects($response);
        $response = $this->call('POST', '/them-binh-luan', [
        'addComment' => ' ',
        'productId' => '1',
        'uploadMedia' => '',
        '_token' => csrf_token()
    ]);
        $response=$this->followRedirects($response)->assertSee('true');
       // $this->assertEquals($response->message,'true');
        $this->call('GET', '/auth/logout');
    }
}  