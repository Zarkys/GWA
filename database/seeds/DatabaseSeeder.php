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
         $this->call(CategorySeeder::class);
         $this->call(TagSeeder::class);
         $this->call(PostSeeder::class);
         $this->call(ComentSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(PostCategorySeeder::class);
         $this->call(PostTagSeeder::class);
         $this->call(AttributeSeeder::class);
         $this->call(TypeProductSeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(ProductAttributeSeeder::class);
         $this->call(TypeProductAttributeSeeder::class);
         $this->call(SectionSeeder::class);
         $this->call(TextSeeder::class);
         $this->call(ConfigWebSeeder::class);
         $this->call(CategoryForProductSeeder::class);
         $this->call(CategoryProductSeeder::class);

    }
}