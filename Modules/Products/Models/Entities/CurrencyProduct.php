<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Database\Eloquent\Model;


class CurrencyProduct extends Model
{

    protected $table = 'currencies_products';

    protected $primaryKey = 'iso';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'iso',
        'name',
        'symbol',
        'thousand_separator',
        'decimal_separator',
        'decimals',
        'active'
    ];


    public function getFullNameAttribute()
    {
        return $this->iso . ' - ' . $this->name;
    }

    public function scopeTitle($query, $value)
    {
        return $query->where('iso', $value)->value('symbol');
    }

}
