<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Section extends Authenticatable {
        use Notifiable;
        protected $table      = 'sections';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'title',    
            'active',
            'created_at',
            'updated_at',
        ]; 
       public function Text() {
            return $this->hasOne(Text::class, 'id_text');
        }       
               
                
        
    }