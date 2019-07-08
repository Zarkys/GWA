<?php
    
    namespace App\Http\Models\Entities;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Role extends Model {
        protected $table = 'roles';
        
        protected $primaryKey = 'id';
        
        public $timestamps = false;
        
        public $fillable = [
            'id',
            'name',
        ];
        
        public function permissions() {
            return $this->belongsToMany(Permission::class);
        }
        
        public function users() {
            return $this->belongsToMany(User::class);
        }
    }
