<?php

namespace Modules\Blog\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CategoryBlog extends Authenticatable
{
    use Notifiable;
    protected $table = 'blog_categories_blog';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
//        'id_user',
        'active',
        'created_at',
        'updated_at',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

//    public function user()
//    {
//        return $this->hasOne(User::class, 'id', 'id_user');
//    }

}


