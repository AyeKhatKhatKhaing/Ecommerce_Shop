<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use DB;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_role')->truncate();

        $role        = Role::find(1);

        $permissions = Permission::all();

        $data        = [];

        foreach ($permissions as $permission) {
            $data [] = [
                'role_id'       => $role->id,
                'permission_id' => $permission->id,
            ];
        }

        DB::table('permission_role')->insert($data);
    }
}
