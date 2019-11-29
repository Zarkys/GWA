<?php

namespace Modules\Blog\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CommentBlog extends Authenticatable
{
    use Notifiable;
    protected $table = 'blog_comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'comment',
        'publication_date',
        'id_post',
        'id_user',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }


}