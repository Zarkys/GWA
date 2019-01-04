<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        \App\Http\Models\Entities\User::create([    

            'name' => 'Admin User',
            'email'=> 'admin@gmail.com',
            'rol'=> 2, 
            'email_verified_at'=> null, 
            'password'=> '123456',
            'remember_token'=> bcrypt('123456')
           
        ]);      
    }
}
