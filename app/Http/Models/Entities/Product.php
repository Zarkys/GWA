<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Product extends Authenticatable {
        use Notifiable;
        protected $table      = 'products';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',           
            'id_type_product', 
            'active',
            'created_at',
            'updated_at',
        ]; 
        public function TypeProduct() {
            return $this->hasOne(TypeProduct::class, 'id', 'id_type_product');
        }        
               
                
        
    }