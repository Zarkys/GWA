<?php

namespace Modules\Products\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CategoryProduct extends Authenticatable
{
    use Notifiable;
    protected $table = 'prod_categories_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'active',
        'created_at',
        'updated_at',
    ];

    public function Products()
    {
        return $this->hasMany(Product::class, 'id_category', 'id');
    }

}


