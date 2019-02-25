<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class PostCategory extends Authenticatable {
        use Notifiable;
        protected $table      = 'posts_categories';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_post',           
            'id_category', 
            'active',
            'created_at',
            'updated_at',
        ]; 
        public function Post() {
            return $this->hasOne(Post::class, 'id', 'id_post');
        } 
         public function Category() {
            return $this->hasOne(Category::class, 'id', 'id_category');
        }        
               
                
        
    }