<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Enums\Permissions;
use App\Http\Models\Enums\Roles;

class PermissionRoleTableSeeder extends Seeder
{


    public function run()
    {

        //        Permission roles root

//        \DB::table('permission_role')->insert([
//            'permission_id' => Permissions::$login,
//            'role_id' => Roles::$root,
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);
//
//        \DB::table('permission_role')->insert([
//            'permission_id' => Permissions::$root,
//            'role_id' => Roles::$root,
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);

        //        Permission roles admin

        \DB::table('permission_role')->insert([
            'permission_id' => Permissions::$login,
            'role_id' => Roles::$admin,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        \DB::table('permission_role')->insert([
            'permission_id' => Permissions::$admin,
            'role_id' => Roles::$admin,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
