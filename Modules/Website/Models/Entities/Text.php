<?php
    
    namespace Modules\Website\Models\Entities;


    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Text extends Authenticatable {
        use Notifiable;
        protected $table      = 'texts';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',           
            'value_es',
            'value_en', 
            'id_section',
            'active',
            'created_at',
            'updated_at',
        ]; 
        public function Section() {
            return $this->hasOne(Section::class, 'id', 'id_section');
        }         
               
                
        
    }
