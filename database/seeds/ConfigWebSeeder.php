<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Enums\Gender;

class ConfigWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $coment = \App\Http\Models\Entities\ConfigWeb::create([  
            'name_config' => 'email_receive',
            'value'=> 'guruvsoftware@gmail.com', 
            'active' => 1,  
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'audit_comments',
            'value'=> 'yes', 
            'active' => 1,  
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([ 
            'name_config' => 'email_sender',
            'value'=> 'guruvsoftware@gmail.com', 
            'active' => 1, 
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([ 
            'name_config' => 'mail_driver',
            'value'=> 'smtp', 
            'active' => 1,     
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([  
            'name_config' => 'mail_host',
            'value'=> 'smtp.mailtrap.io', 
            'active' => 1,   
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'mail_port',
            'value'=> '2525', 
            'active' => 1, 
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'mail_username',
            'value'=> 'null', 
            'active' => 1, 
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'mail_password',
            'value'=> 'null', 
            'active' => 1, 
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'mail_encryption',
            'value'=> 'null', 
            'active' => 1, 
        ]);
        $coment = \App\Http\Models\Entities\ConfigWeb::create([   
            'name_config' => 'url_logo_company',
            'value'=> 'null', 
            'active' => 1, 
        ]);
    }
}
