<?php

namespace Modules\Doctors\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use Notifiable;
    protected $table = 'doct_doctors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'consulting_room',
        'phone',
        'id_specialty',
        'active',
        'created_at',
        'updated_at',
    ];

    public function Specialty()
    {
        return $this->hasOne(Specialty::class, 'id', 'id_specialty');
    }


}