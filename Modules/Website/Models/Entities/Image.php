<?php

namespace Modules\Website\Models\Entities;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Image extends Authenticatable
{
    use Notifiable;
    protected $table = 'sitew_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'image',
        'images',
        'id_section',
        'active',
        'created_at',
        'updated_at',
    ];

    public function Section()
    {
        return $this->hasOne(Section::class, 'id', 'id_section');
    }


}
