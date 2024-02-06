<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'all-menu']);
        Permission::create(['name' => 'reception']);
        Permission::create(['name' => 'room']);
        Permission::create(['name' => 'food']);
    }
}
