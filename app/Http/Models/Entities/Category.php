<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Category extends Authenticatable {
        use Notifiable;
        protected $table      = 'categories';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',
            'slug',           
            'description',
            'parent_category', 
            'active',
            'created_at',
            'updated_at',
        ];       
            

        public function PostCategory() {
            return $this->hasOne(PostCategory::class, 'id_category');
        }
       
        
    }