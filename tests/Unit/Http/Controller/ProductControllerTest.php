<?php

//use App\Events\CityShown;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;
use App\Http\Controllers\ProductController;

class ProductControllerTest extends TestCase
{
     public function test_viewDetailProduct()
    {
        $controller = new ProductController();

        $view = $controller->viewDetailProduct();

        $this->assertEquals('SupplierView.detail_product', $view->getName());
    }
     
    
     

}
