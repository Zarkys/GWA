<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DetailsOrder extends Authenticatable
{
    use Notifiable;
    protected $table = 'prod_details_order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_order',
        'id_product',
        'amount',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

}