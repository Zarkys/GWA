<?php

namespace Modules\Products\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    use Notifiable;
    protected $table = 'prod_orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'number_order',
        'id_user',
        'amount_total',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Details()
    {
        return $this->hasMany(DetailsOrder::class, 'id_order', 'id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

}