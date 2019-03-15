<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Contact extends Authenticatable {
        use Notifiable;
        protected $table      = 'contacts';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name_client',           
            'email_client', 
            'phone_client',
            'message_client', 
            'active',          
            'created_at',
            'updated_at',
        ]; 
    }