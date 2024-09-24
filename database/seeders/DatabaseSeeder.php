<?php

namespace Database\Seeders;

use App\Models\CategoryUnitMesure;
use App\Models\UnitMesure;
use App\Models\User;
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
            ['name' => 'ADMIN', 'id' => 2],
            ['name' => 'VENDEDOR', 'id' => 3],
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

        CategoryUnitMesure::factory()->create([
            'name' => 'Unidad',
            'description' => 'Unidad de medida',
            'created_by' => 1,
        ]);

        CategoryUnitMesure::factory()->create([
            'name' => 'Kiloje',
            'description' => 'Unidad de medida',
            'created_by' => 1,
        ]);

        CategoryUnitMesure::factory()->create([
            'name' => 'Liquidos',
            'description' => 'Unidad de medida',
            'created_by' => 1,
        ]);

        UnitMesure::factory()->create([
            'description' => 'u.',
            'category_unit_mesure_id' => 1,
            'created_by' => 1,
        ]);

        UnitMesure::factory()->create([
            'description' => 'gr.',
            'category_unit_mesure_id' => 2,
            'created_by' => 1,
        ]);

        UnitMesure::factory()->create([
            'description' => 'Kg.',
            'category_unit_mesure_id' => 2,
            'created_by' => 1,
        ]);

        UnitMesure::factory()->create([
            'description' => 'ml.',
            'category_unit_mesure_id' => 3,
            'created_by' => 1,
        ]);

        UnitMesure::factory()->create([
            'description' => 'L.',
            'category_unit_mesure_id' => 3,
            'created_by' => 1,
        ]);
    }
}
