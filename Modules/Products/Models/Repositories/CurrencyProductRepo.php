<?php

namespace Modules\Products\Models\Repositories;


use Modules\Products\Models\Entities\CurrencyProduct;
use Modules\Products\Models\Enums\ActiveCurrency;

class CurrencyProductRepo
{

    public function all()
    {
        $data = CurrencyProduct::orderBy('active', 'desc')->get();

        return $data;
    }

    public function allActive()
    {
        $data = CurrencyProduct::orderBy('name', 'asc')->where(['active' => ActiveCurrency::$activated])->get();

        return $data;
    }

    public function find($id)
    {

        $data = CurrencyProduct::where('iso', $id)->first();

        return $data;
    }

    public function update($data, $val)
    {

        $data->fill($val);
        $data->save();

        return $data;
    }

    public function delete($id)
    {

        $data = CurrencyProduct::where('iso', $id)->delete();

        return $data;

    }

}
