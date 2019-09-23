<?php

namespace Modules\Products\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AttributeProduct extends Authenticatable
{

    use Notifiable;
    protected $table = 'prod_attributes_products';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'value',
        'show_attr',
        'id_user',
        'id_product',
    ];

    public function Products()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

}