<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class TypeProductAttribute extends Authenticatable {
        use Notifiable;
        protected $table      = 'types_products_attributes';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',     
            'id_attribute',
            'id_type_product', 
            'active',
            'created_at',
            'updated_at',
        ]; 
        
        public function Attribute() {
            return $this->hasOne(Attribute::class, 'id', 'id_attribute');
        } 
         public function TypeProduct() {
            return $this->hasOne(TypeProduct::class, 'id', 'id_type_product');
        }       
               
                
        
    }