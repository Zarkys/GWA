<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class CategoryProduct extends Authenticatable {
        use Notifiable;
        protected $table      = 'categories_products';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_product',           
            'id_category_for_product', 
            'active',
            'created_at',
            'updated_at',
        ];
         public function Product(){
            return $this->hasOne(Product::class, 'id', 'id_product');
        } 
         public function CategoryForProduct(){
            return $this->hasOne(CategoryForProduct::class, 'id', 'id_category_for_product');
        }        
                
        
    }