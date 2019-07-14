<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class ConfigModule extends Authenticatable {
        use Notifiable;
        protected $table      = 'config_module';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name_module',           
            'status', 
            'active',
            'created_at',
            'updated_at',
        ]; 
       
               
                
        
    }