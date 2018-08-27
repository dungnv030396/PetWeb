<?php

namespace Tests\Unit\Http\Controllers;

//use App\Events\CityShown;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Mockery as m;
//use App\City;
use Illuminate\Database\Connection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Tests\TestCase;
//use Illuminate\Http\Request;
use App\Http\Controllers\PageController;

class PageControllerTest extends TestCase
{
     public function test_getIndex()
    {
        $controller = new PageController();

        $view = $controller->getIndex();

        $this->assertEquals('clientViews.trangchu', $view->getName());
    }
    public function test_getProductsByType()
    {
        $request = new Request();
        $request->cata_id=1;$request->cate_id=1;
        $controller = new PageController();

        $view = $controller->getProductsByType($request);

        $this->assertEquals('clientViews.loai_sanpham', $view->getName());
    }
    public function test_getProductDetail()
    {
        $request = new Request();
        $request->id=1;
        $controller = new PageController();

        $view = $controller->getProductDetail($request);

        $this->assertEquals('clientViews.chitiet_sanpham', $view->getName());
    }
     public function test_getLienHe()
    {
        $controller = new PageController();

        $view = $controller->getLienHe();

        $this->assertEquals('clientViews.supports.lienhe', $view->getName());
    }
     public function test_getGioiThieu()
    {
        $controller = new PageController();

        $view = $controller->getGioiThieu();

        $this->assertEquals('clientViews.supports.gioi_thieu', $view->getName());
    }

}
