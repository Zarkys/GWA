<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class ArchiveAssignment extends Authenticatable {
        use Notifiable;
        protected $table      = 'archives_assignments';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'id_page',
            'id_post',           
            'id_archive', 
            'active',
            'created_at',
            'updated_at',
        ];    

        public function Post() {
            return $this->hasOne(Post::class, 'id', 'id_post');
        } 
         public function Page() {
            return $this->hasOne(Tag::class, 'id', 'id_page');
        }
         public function Archive() {
            return $this->hasOne(Tag::class, 'id', 'id_archive');
        }    
                
        
    }