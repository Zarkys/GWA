<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Page extends Authenticatable {
        use Notifiable;
        protected $table      = 'pages';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'title',
            'content',           
            'id_featured_image',
            'visibility', 
            'status_page',
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
         public function ArchiveAssignment() {
            return $this->hasOne(ArchiveAssignment::class, 'id_page');
        }    
                
        
    }