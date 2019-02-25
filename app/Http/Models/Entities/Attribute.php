<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Attribute extends Authenticatable {
        use Notifiable;
        protected $table      = 'attributes';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',           
            'description', 
            'active',
            'created_at',
            'updated_at',
        ];       
                
        public function ProductAttribute() {
            return $this->hasOne(ProductAttribute::class, 'id_attribute');
        }
        public function TypeProductAttribute() {
            return $this->hasOne(TypeProductAttribute::class, 'id_attribute');
        }
    }