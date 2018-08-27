<?php

namespace Tests\Unit;

use App\OrderLine;
use App\Order;
use Tests\ModelTestCase;

class OrderLineTest extends ModelTestCase
{
    
    public function test_orderline_relation_order()
    {
        $c = new OrderLine();
        $u = $c->orders();
        $this->assertBelongsToRelation($u, $c, new Order(),'orders_id');
    }
    
}
