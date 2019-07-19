<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Enums\ActiveModule;

class ConfigModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configmodule = \App\Http\Models\Entities\ConfigModule::create([  
            'name_module' => 'Traductor',
            'status'=> ActiveModule::$disabled, 
            'active' => 1,  
        ]);
    }
}
