<?php
    
    namespace App\Http\Models\Entities;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Tag extends Authenticatable {
        use Notifiable;
        protected $table      = 'tags';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',
            'slug',           
            'description', 
            'active',
            'created_at',
            'updated_at',
        ];       
                
        public function PostTag() {
            return $this->hasOne(PostTag::class, 'id_tag');
        }
    }