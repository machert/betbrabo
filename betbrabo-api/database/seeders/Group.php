<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group as ModelsGroup;

class Group extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ModelsGroup::create(['name'=>'admin']);
        ModelsGroup::create(['name'=>'manager']);
        ModelsGroup::create(['name'=>'client']);

    }
}
