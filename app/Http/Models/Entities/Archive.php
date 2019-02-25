<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Archive extends Authenticatable {
        use Notifiable;
        protected $table      = 'archives';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',
            'type',           
            'creation_date',
            'size',
            'dimension',
            'url',
            'title', 
            'legend',
            'alternative_text',           
            'description', 
            'id_user',
            'active',
            'created_at',
            'updated_at',
        ];    

       
        public function User() {
            return $this->hasOne(User::class, 'id', 'id_user');
        }   
                
       
    }
    