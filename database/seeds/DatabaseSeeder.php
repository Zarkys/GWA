<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ConfigWebSeeder::class);
        $this->call(ConfigModuleSeeder::class);

    }
}