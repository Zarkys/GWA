<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Coment extends Authenticatable {
        use Notifiable;
        protected $table      = 'coments';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'coment',
            'id_answer_to',           
            'id_post',
            'status_coment', 
            'publication_date',
            'id_user', 
            'active',
            'created_at',
            'updated_at',
        ];   

         public function Post() {
            return $this->hasOne(Post::class, 'id', 'id_post');
        }    
                
        
    }