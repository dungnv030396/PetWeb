<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditProfileTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
    public function test_editProfile()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_editProfile1()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '0',
        'phonenumber' => '1234567891',
        'address' => 'Hồ Chí Minh',
        'bank_name'=> 'TPBank',
        'bank_username'=> 'hiepsky',
        'card_number'=> '12435',
        'bank_branch'=> 'Hồ Chí Minh',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
        
        $this->call('GET', '/auth/logout');
    }      
    public function test_editProfile_Phone_digitsbetween()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '1234',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoại phải có 10-11 chữ số!');
        
        $this->call('GET', '/auth/logout');
    }   
    public function test_editProfile_Phone_digitsbetween1()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '1234567891056783',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoại phải có 10-11 chữ số!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_editProfile_phoneNumeric()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '12345aa7891',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoải không chưa kí tự khác chữ số!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_editProfile_phoneNumeric1()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '#@$3457891',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số điện thoải không chưa kí tự khác chữ số!');
        
        $this->call('GET', '/auth/logout');
    }
    public function test_editProfile_cardNumeric()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '12b35',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số tài khoản không chưa kí tự khác chữ số!');
        
        $this->call('GET', '/auth/logout');
    } 
    public function test_editProfile_cardNumeric1()
    {
        $this->get('/index');
        $response = $this->call('POST', '/login', [
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'password' => '123456',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response);
        $response = $this->call('GET', 'userProfile/1');

        $this->followRedirects($response);
         $response = $this->call('POST', '/update-information', [
        'mem_name' => 'sky',
        'emailid' => 'hiepnhse03561@fpt.edu.vn',
        'gender' => '1',
        'phonenumber' => '1234567891',
        'address' => 'Đà Nẵng',
        'bank_name'=> 'Agribank',
        'bank_username'=> 'hiep',
        'card_number'=> '%2435',
        'bank_branch'=> 'Hải Châu, Đà Nẵng',
        '_token' => csrf_token()
    ]);
        $this->followRedirects($response)->assertSee('Số tài khoản không chưa kí tự khác chữ số!');
        
        $this->call('GET', '/auth/logout');
    }           
   
}   