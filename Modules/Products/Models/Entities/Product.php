<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    use Notifiable;
    protected $table = 'prod_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'price',
        'price_discount',
        'active',
        'show_price',
        'id_type',
        'id_category',
        'currency',
        'created_at',
        'updated_at',
    ];

    public function TypeProduct()
    {
        return $this->hasOne(TypeProduct::class, 'id', 'id_type');
    }

    public function CategoryProduct()
    {
        return $this->hasOne(CategoryProduct::class, 'id', 'id_category');
    }

    public function CurrencyProduct()
    {
        return $this->hasOne(CurrencyProduct::class, 'iso', 'currency');
    }

    public function AttributeProduct()
    {
        return $this->hasMany(AttributeProduct::class, 'id_product', 'id');
    }

    public function ProductImages()
    {
        return $this->hasMany(ProductImage::class, 'id_product', 'id');
    }

}