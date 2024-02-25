<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUser::create([
            'name' => 'admin',
            'cpf' => '17670758040',
            'password' => bcrypt('1234'),
            'email' => 'admin@gmail.com'
        ]);
        
        ModelsUser::create([
            'name' => 'manager',
            'cpf' => '10884475034',
            'password' => bcrypt('1234'),
            'email' => 'manager@gmail.com'
        ]);
        
        ModelsUser::create([
            'name' => 'client1',
            'cpf' => '75144694004',
            'password' => bcrypt('1234'),
            'email' => 'client1@gmail.com'
        ]);
        
        ModelsUser::create([
            'name' => 'client2',
            'cpf' => '95757387050',
            'password' => bcrypt('1234'),
            'email' => 'client2@gmail.com'
        ]);
        
        ModelsUser::create([
            'name' => 'client3',
            'cpf' => '84282602066',
            'password' => bcrypt('1234'),
            'email' => 'client3@gmail.com'
        ]);
        


    }
}
