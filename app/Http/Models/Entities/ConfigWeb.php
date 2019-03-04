<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class ConfigWeb extends Authenticatable {
        use Notifiable;
        protected $table      = 'config_web';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name_config',           
            'value', 
            'active',
            'created_at',
            'updated_at',
        ]; 
       
               
                
        
    }