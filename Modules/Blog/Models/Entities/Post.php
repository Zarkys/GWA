<?php

namespace Modules\Blog\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{

    use Notifiable;
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'image',
        'active',
        'status_post',
        'id_user',
        'id_category',
        'publication_date',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->hasOne(CategoryBlog::class, 'id', 'id_category');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentBlog::class, 'id_post', 'id');
    }


}
