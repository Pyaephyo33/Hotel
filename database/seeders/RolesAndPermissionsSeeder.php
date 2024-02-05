<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);

        // permissions
        Permission::create(['name' => 'edit rooms']);
        Permission::create(['name' => 'delete rooms']);
        Permission::create(['name' => 'room types']);


        // assign permissions to roles
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(['edit rooms', 'delete rooms','room types']);

        $editor = Role::findByName('editor');
        $editor->givePermissionTo('edit rooms');
    }
}
