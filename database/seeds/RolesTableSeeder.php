<?php
    
    use Illuminate\Database\Seeder;
    
    class RolesTableSeeder extends Seeder {
        
        public function run() {
            \App\Http\Models\Entities\Role::create([
                'name' => 'Root',
            ]);
    
            \App\Http\Models\Entities\Role::create([
                'name' => 'Admin',
            ]);
    
            \App\Http\Models\Entities\Role::create([
                'name' => 'Company',
            ]);
        }
    }
