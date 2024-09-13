<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'SUPERADMIN ADMIN', 'id' => 1],
            ['name' => 'VENDEDOR', 'id' => 2],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'patrick@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('12345'),
        ]);
    }
}
