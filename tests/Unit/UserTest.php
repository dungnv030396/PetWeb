<?php

namespace Tests\Unit;

use App\User;
use App\Comment;
use Tests\ModelTestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTest extends ModelTestCase
{
    public function test_model_configuration()
    {
        $this->runConfigurationAssertions(new User(), [
            'name', 'email', 'password',
        ], [
            'password', 'remember_token',
        ]);
    }
    public function test_user_relation_comments()
    {
        $u = new User();
        $c = $u->comments();
        $this->assertHasManyRelation($c, $u, new Comment());
    }
    // public function test_user_relation_reports()
    // {
    //     $u = new User();
    //     $c = $u->comments();
    //     $this->assertHasManyRelation($c, $u, new Comment());
    // }
}
