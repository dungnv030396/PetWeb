<?php

namespace Tests\Unit;

use App\Report;
use App\User;
use Tests\ModelTestCase;

class ReportTest extends ModelTestCase
{
    
    public function test_report_relation_user()
    {
       
        $c = new Report();
        $u = $c->users();
        $this->assertBelongsToRelation($u, $c, new User(),'users_id');
    }
    
}
