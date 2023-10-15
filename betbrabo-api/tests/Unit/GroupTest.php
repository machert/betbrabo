<?php

namespace Tests\Unit;

use App\Models\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{

    public function test_check_new_group(): void
    {
        $group = new Group();
        $this->assertIsObject($group);
        $this->assertNotNull($group);
    }
    public function test_check_new_group_with_name_admin(): void
    {
        $group = new Group();
        $group->name = "admin";
        $this->assertEquals($group->name, "admin");
        $this->assertNotEquals($group->name, "user");
    }
    
    public function test_check_new_group_with_name_admin_change_name_to_user(): void
    {
        $group = new Group();
        $group->name = "admin";
        $group->name = "user";
        $this->assertEquals($group->name, "user");
        $this->assertNotEquals($group->name, "admin");
    }

    public function test_check_if_group_columns_is_correct(){
        $group = new Group();

        $expected = [
            'name',
            'created_at',
            'updated_at',
        ];

        $arrayCompared = array_diff($expected, $group->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
