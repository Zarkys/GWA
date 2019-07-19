<?php

namespace Modules\Records\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Records extends Authenticatable
{
    
    use Notifiable;
    protected $table = 'records';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'type',
        'url',
        'size',
        'dimension',
        'legend',
        'id_user',
        'active',
        'created_at',
        'updated_at',
    ];


    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }


}
    