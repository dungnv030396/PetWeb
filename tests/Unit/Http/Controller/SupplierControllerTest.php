<?php

//use App\Events\CityShown;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Connection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\User;
use Tests\TestCase;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupplierController;

class SupplierControllerTest extends TestCase
{
     public function test_listSupplier()
    {
        $controller = new SupplierController();

        $view = $controller->listSupplier();

        $this->assertEquals('clientViews.customer.list_supplier', $view->getName());
    }
     public function test_addProductView()
    {
        $controller = new SupplierController();

        $view = $controller->addProductView();

        $this->assertEquals('SupplierView.add_product_view', $view->getName());
    }
    //  public function test_ordersHistory()
    // {
    //     // $user = factory(User::class)->create();
    //     // $response = $this->actingAs($user)
    //     //                  ->withSession(['foo' => 'bar'])
    //     //                  ->get('/customer/ordershistory/1');
        

    //     $controller = new PaymentController();

    //     $view = $controller->ordersHistory();

    //     $this->assertEquals('clientViews.customer.orders_history', $view->getName());
    // }
    
     

}
