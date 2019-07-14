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
         $this->call(ArchiveSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(AttributeSeeder::class);
         $this->call(TypeProductSeeder::class);
         $this->call(CategoryForProductSeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(ProductAttributeSeeder::class);
         $this->call(TypeProductAttributeSeeder::class);
         $this->call(ConfigWebSeeder::class);
          $this->call(ConfigModuleSeeder::class);
         $this->call(CategoryProductSeeder::class);

    }
}