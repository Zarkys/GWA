<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class ProductAttribute extends Authenticatable {
        use Notifiable;
        protected $table      = 'products_attributes';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_product',           
            'id_attribute',
            'value',  
            'active',
            'created_at',
            'updated_at',
        ]; 
        public function Product() {
            return $this->hasOne(Product::class, 'id', 'id_product');
        } 
        public function Attribute() {
            return $this->hasOne(Attribute::class, 'id', 'id_attribute');
        }        
               
                
        
    }