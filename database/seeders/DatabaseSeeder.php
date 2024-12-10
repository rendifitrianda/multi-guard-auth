<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $costumer = User::factory()->create([
            'name' => 'Costumer',
            'email' => 'costumer@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user_role = Role::create(['name' => 'User']);
        $costumer_role = Role::create(['name' => 'Costumer']);

        $user->assignRole($user_role);
        $costumer->assignRole($costumer_role);
    }
}
