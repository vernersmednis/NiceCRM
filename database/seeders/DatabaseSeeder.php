<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            // EmployeeSeeder MUST be run AFTER the CompanySeeder
            // because the employee foreign key 'company_id' requires an existing entry
            EmployeeSeeder::class,
        ]);
    }
}
