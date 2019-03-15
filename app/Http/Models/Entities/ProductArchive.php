<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class ProductArchive extends Authenticatable {
        use Notifiable;
        protected $table      = 'products_archives';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_product',           
            'id_archives',          
            'active',
            'created_at',
            'updated_at',
        ]; 
        public function Product() {
            return $this->hasOne(Product::class, 'id', 'id_product');
        } 
        public function Archives() {
            return $this->hasOne(Archives::class, 'id', 'id_archives');
        }        
               
                
        
    }