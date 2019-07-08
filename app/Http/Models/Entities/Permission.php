<?php
    
    namespace App\Http\Models\Entities;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Permission extends Model {
        
        protected $table = 'permissions';
        
        
        protected $primaryKey = 'id';
        
        public $timestamps = false;
        
        public $fillable = [
            'id',
            'name',
        ];
    }
