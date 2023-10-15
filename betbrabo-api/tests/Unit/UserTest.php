<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{ 
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function test_check_new_user(): void
    {
        $user = new User();
        $this->assertIsObject($user);
        $this->assertNotNull($user);
    }
    public function test_check_new_user_with_name_felipe(): void
    {
        $user = new User();
        $user->name = "felipe";
        $this->assertEquals($user->name, "felipe");
        $this->assertNotEquals($user->name, "user");
    }
    
    public function test_check_new_user_with_name_felipe_change_name_to_user(): void
    {
        $user = new User();
        $user->name = "felipe";
        $user->name = "user";
        $this->assertEquals($user->name, "user");
        $this->assertNotEquals($user->name, "felipe");
    }

}
