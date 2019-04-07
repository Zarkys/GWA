<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class CategoryForProduct extends Authenticatable {
        use Notifiable;
        protected $table      = 'categories_for_products';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',           
            'description', 
            'active',
            'created_at',
            'updated_at',
        ];       
            

        public function CategoryProduct() {
            return $this->hasOne(CategoryProduct::class, 'id_category_for_product');
        }
        public function Product() {
            return $this->hasOne(Product::class, 'id_category_for_product');
        }
       
        
    }