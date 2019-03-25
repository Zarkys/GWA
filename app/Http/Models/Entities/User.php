<?php
    
    namespace App\Http\Models\Entities;
    use Laravel\Passport\HasApiTokens;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Support\Facades\Log;
    class User extends Authenticatable {
        
        protected $table      = 'users';
        protected $primaryKey = 'id';
    
        use Notifiable;
        use HasApiTokens, Notifiable;
        
        protected $fillable = [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'rol',
            'active',
            'remember_token',           
            'created_at',
            'updated_at',
        ];
        
        protected $hidden = [
            'password',
            'remember_token',
        ];
        
        public function setPasswordAttribute($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    
        public function scopeToken($query, $value) {
            return $query->where('token', $value)->first();
        }
    
        public function Rol() {
            return $this->hasOne(Role::class, 'id', 'rol');
        }
    
        public function Post() {
            return $this->hasOne(Post::class, 'id_user');
        }
        public function Page() {
            return $this->hasOne(Page::class, 'id_user');
        }
        public function Archive() {
            return $this->hasOne(Archive::class, 'id_user');
        }
        public function Coment() {
            return $this->hasOne(Coment::class, 'id_user');
        }
        

        
    }
