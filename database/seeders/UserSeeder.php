<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::factory()->count(10)->create();

        $role_id = Role::where('name','user')->first()->id;
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com', // Adjust email as needed
            'password' => bcrypt('12345678'), // Adjust password as needed
            'role_id' => $role_id
        ]);
    }
}
