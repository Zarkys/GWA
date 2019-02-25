<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Post extends Authenticatable {
        use Notifiable;
        protected $table      = 'posts';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'title',
            'content',           
            'id_featured_image',
            'visibility', 
            'status_post',
            'id_user', 
            'permanent_link',
            'creation_date',
            'publication_date', 
            'modification_date', 
            'active',
            'created_at',
            'updated_at',
        ];   

         
         public function Archive() {
            return $this->hasOne(Archive::class, 'id', 'id_featured_image');
        } 
        public function User() {
            return $this->hasOne(User::class, 'id', 'id_user');
        }
         public function PostCategory() {
            return $this->hasOne(PostCategory::class, 'id_post');
        } 
         public function PostTag() {
            return $this->hasOne(PostTag::class, 'id_post');
        } 
         public function Coment() {
            return $this->hasOne(Coment::class, 'id_post');
        }    
                
        
    }