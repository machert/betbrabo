<?php

namespace Database\Seeders;

use App\Models\UserGroup as ModelsUserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroup extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUserGroup::create([
            'users_id' => 1,
            'groups_id' => 1
        ]);
        
        ModelsUserGroup::create([
            'users_id' => 2,
            'groups_id' => 2
        ]);
        
        ModelsUserGroup::create([
            'users_id' => 3,
            'groups_id' => 3
        ]);
        
        ModelsUserGroup::create([
            'users_id' => 4,
            'groups_id' => 3
        ]);
        
        ModelsUserGroup::create([
            'users_id' => 5,
            'groups_id' => 3
        ]);
        
    }
}
