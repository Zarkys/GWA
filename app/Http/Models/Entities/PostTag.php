<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class PostTag extends Authenticatable {
        use Notifiable;
        protected $table      = 'posts_tags';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_post',           
            'id_tag', 
            'active',
            'created_at',
            'updated_at',
        ];
         public function Post() {
            return $this->hasOne(Post::class, 'id', 'id_post');
        } 
         public function Tag() {
            return $this->hasOne(Tag::class, 'id', 'id_tag');
        }        
                
        
    }