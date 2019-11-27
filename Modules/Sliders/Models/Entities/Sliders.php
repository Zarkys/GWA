<?php

namespace Modules\Sliders\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Sliders extends Authenticatable
{

    use Notifiable;
    protected $table = 'sli_sliders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'name',
        'url',
        'status',
        'created_at',
        'updated_at',
    ];

}
    