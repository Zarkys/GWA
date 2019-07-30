<?php

namespace Modules\Products\Models\Entities;

use App\Http\Models\Entities\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TypeProduct extends Authenticatable
{
    use Notifiable;
    protected $table = 'types_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
        'id_user',
        'created_at',
        'updated_at',
    ];

    public function Products()
    {
        return $this->hasMany(Product::class, 'id_type', 'id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

//    public function TypeProductAttribute()
//    {
//        return $this->hasOne(TypeProductAttribute::class, 'id_type_product');
//    }
}