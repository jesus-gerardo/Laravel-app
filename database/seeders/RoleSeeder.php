<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $directivo = Role::create(['name' => 'directivo']);
        $docentes  = Role::create(['name' => 'docentes']);

        // permission
        Permission::create(['name' => 'api.alumnos.index'])->syncRoles([$directivo, $docentes]);
        Permission::create(['name' => 'api.alumnos.store'])->syncRoles([$directivo]);
    }
}
