<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Records\Models\Entities\Records;

class ProductImage extends Authenticatable
{

    use Notifiable;
    protected $table = 'prod_product_image';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_archive',
        'id_product',
    ];

    public function ProductRecords()
    {
        return $this->hasMany(Records::class, 'id', 'id_archive');
    }

}