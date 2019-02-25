<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class TypeProduct extends Authenticatable {
        use Notifiable;
        protected $table      = 'types_products';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',           
            'description', 
            'active',
            'created_at',
            'updated_at',
        ];       
                
        public function Product() {
            return $this->hasOne(Product::class, 'id_type_product');
        }
        public function TypeProductAttribute() {
            return $this->hasOne(TypeProductAttribute::class, 'id_type_product');
        }
    }