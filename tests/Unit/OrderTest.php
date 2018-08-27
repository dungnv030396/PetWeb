<?php

namespace Tests\Unit;

use App\OrderLine;
use App\Order;
use App\User;
use Tests\ModelTestCase;

class OrderTest extends ModelTestCase
{
    
    public function test_order_relation_orderline()
    {
        $p = new Order();
        $c = $p->orderLine();
        $this->assertHasManyRelation($c, $p, new OrderLine());
    }
    
}
