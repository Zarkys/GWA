<?php
    
    use Illuminate\Database\Seeder;
    
    class PermissionsTableSeeder extends Seeder {
        
        public function run() {
            \App\Http\Models\Entities\Permission::create([
                'name' => 'Login',
            ]);
            
            \App\Http\Models\Entities\Permission::create([
                'name' => 'Root',
            ]);
            
            \App\Http\Models\Entities\Permission::create([
                'name' => 'Admin',
            ]);
            
            \App\Http\Models\Entities\Permission::create([
                'name' => 'Company',
            ]);
            
        }
    }
