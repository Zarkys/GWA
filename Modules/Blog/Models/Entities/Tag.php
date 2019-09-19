<?php

namespace Modules\Blog\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tag extends Authenticatable
{

    use Notifiable;
    protected $table = 'blog_tags';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'id_user',
        'active',
        'created_at',
        'updated_at',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
